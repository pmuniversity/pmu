<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use Illuminate\Database\QueryException;


class UsersController extends Controller
{
    /**
     * Illuminate\Http\Request.
     *
     * @var request
     */
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /**
     * @param UserRepository $userRepository
     * @return string
     */
    public function store(UserRepository $userRepository)
    {
        try {
            $this->validate($this->request, [
                'email' => 'required|email|unique:users,email'
            ]);
            $userRepository->create(array_merge($this->request->only('email'), ['news_letter_subscribed' => 1]));
            if ($this->request->ajax())
                return response()->json([
                    'data' => [
                        'message' => 'Thank you for subscribing'
                    ],
                ]);
        } catch (QueryException $e) {
            return response()->json([
                'data' => [
                    'message' => 'Some thing went wrong'.$e->getMessage()
                ],
            ]);
        }
    }
}
