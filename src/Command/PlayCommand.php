<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/8/18
 * Time: 4:55 PM
 */

namespace Connect4\Command;

use Connect4\Board\BoardInterface;
use Connect4\Board\Exceptions\BoardColumnIsFullException;
use Connect4\Board\Exceptions\InvalidColumnException;
use Connect4\Board\Piece\ConsolePiece;
use Connect4\Board\Piece\Piece;
use Connect4\Board\SimpleBoard;
use Connect4\Player\HumanPlayer;
use Connect4\Player\RandomBotPlayer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class PlayCommand extends Command
{
    protected $output;
    protected $input;
    /**
     * @var SimpleBoard
     */
    protected $board;

    protected function configure()
    {
        $this
            ->setName('play')
            ->setDescription('Starts a game with a dumb bot')
            ->addOption('rows', 'r',InputArgument::OPTIONAL, 'Customize board rows',6)
            ->addOption('columns', 'c',InputArgument::OPTIONAL, 'Customize board columns',7)

            ->setHelp('...');
    }

    public function setup($output, $input)
    {
        $this->output = $output;
        $this->input = $input;

        $rows = intval($input->getOption('rows'));
        $columns = intval($input->getOption('columns'));

        $this->board = new SimpleBoard($rows,$columns);

        $outputStyle = new OutputFormatterStyle('red', null, array('bold', 'blink'));
        $output->getFormatter()->setStyle('player1', $outputStyle);
        $outputStyle = new OutputFormatterStyle('blue', null, array('bold', 'blink'));
        $output->getFormatter()->setStyle('player2', $outputStyle);
        $outputStyle = new OutputFormatterStyle('white', null, array('bold', 'blink'));
        $output->getFormatter()->setStyle('empty', $outputStyle);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setup($output,$input);

        $output->write(sprintf("\033\143"));
        $this->printBoard();

        while(!$this->board->gameOver()){
            $player1 = new HumanPlayer();
            $player1->setPiece(new Piece('player1'));
            $player2 = new RandomBotPlayer();
            $player2->setPiece(new Piece('player2'));

            $move = false;
            while(!$move){
                try{
                    $helper = $this->getHelper('question');
                    $question = new Question('Select column:', '-1');
                    $column = $helper->ask($input, $output, $question);
                    $column = intval($column);
                    $move = $player1->play($this->board,$column);
                }catch (InvalidColumnException $e){
                    $this->warning('Invalid move, try again.');
                }catch (BoardColumnIsFullException $e){
                    $this->warning('This column is full, try again.');
                }
            }


            if(!$this->board->gameOver()){
                $move = $player2->play($this->board);
            }
            $output->write(sprintf("\033\143"));
            $this->printBoard();
            $this->success('You played '.$column);
            $this->success('Bot played '.$move);
        }

        $output->write(sprintf("\033\143"));
        $this->printBoard();

        if($winner = $this->board->getWinner()){
            $text = "";
            if($player1->getPiece()->getColor() == $winner->getColor()){
                $text = 'You won! Congratulations';
            }
            if($player2->getPiece()->getColor() == $winner->getColor()){
                $text = 'Bot wins! Better luck next time!';
            }
            $color = $winner->getColor();
            $this->output->writeln("<$color>$text</>");
        }


    }

    public function printBoard()
    {
        $mesh = $this->board->readBoard();

        foreach ($mesh as &$row) {
            foreach ($row as &$item) {
                $tag = "empty";
                if ($item) {
                    $tag = $item->getColor();
                }
                $item = "<$tag>x</>";
            }
        }

        $table = new Table($this->output);
        $table
            ->setHeaders(range($this->board->getStartIndex(),$this->board->getColumns()))
            ->setRows($mesh)
        ;
        $table->render();
    }

    public function success($text)
    {
        return $this->output->writeln('<fg=green>'.$text.'</>');
    }

    public function warning($text)
    {
        return $this->output->writeln('<fg=yellow;options=bold>'.$text.'</>');
    }
}