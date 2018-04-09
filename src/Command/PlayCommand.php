<?php
/**
 * Created by PhpStorm.
 * User: magusd
 * Date: 4/8/18
 * Time: 4:55 PM
 */

namespace Connect4\Command;

use Connect4\Board\BoardInterface;
use Connect4\Board\Piece\ConsolePiece;
use Connect4\Board\Piece\Piece;
use Connect4\Board\SimpleBoard;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PlayCommand extends Command
{
    protected $output;
    protected $input;

    protected function configure()
    {
        $this
            ->setName('play')
            ->setDescription('Starts a game with a dumb bot')
            ->setHelp('...');
    }

    public function setup($output, $input)
    {
        $this->output = $output;
        $this->input = $input;

        $outputStyle = new OutputFormatterStyle('red', 'white', array('bold', 'blink'));
        $output->getFormatter()->setStyle('player1', $outputStyle);
        $outputStyle = new OutputFormatterStyle('blue', 'white', array('bold', 'blink'));
        $output->getFormatter()->setStyle('player2', $outputStyle);
        $outputStyle = new OutputFormatterStyle('white', 'white', array('bold', 'blink'));
        $output->getFormatter()->setStyle('empty', $outputStyle);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setup($output,$input);

        $board = new SimpleBoard(6,7);


        $output->write(sprintf("\033\143"));
        $this->printBoard($board);

    }

    public function printBoard(BoardInterface $board)
    {
        $board->addPiece(new ConsolePiece('player1'),5);
        $board->addPiece(new ConsolePiece('player1'),5);

        $mesh = $board->readBoard();


        $table = new Table($this->output);
        $table
            ->setHeaders(range($board->getStartIndex(),$board->getColumns()))
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