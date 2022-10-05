<?php

namespace App\Http\Controllers;

use App\Managers\CommonManager;
use App\Managers\GamesManager;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /** @var GamesManager $manager */
    private $manager;

    public function __construct(GamesManager $manager)
    {
        $this->manager = $manager;
    }

    public function index() {
        return $this->responseSuccess($this->manager->all());
    }
}
