<?php

namespace App\Http\Controllers;

use App\User;
use App\Repository\conversationRepository;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ConversationsController extends Controller
{
    private $conversationRepository;
    private $auth;

    public function __construct(ConversationRepository $conversationRepository, AuthManager $auth) 
    {
        $this->conversationRepository = $conversationRepository;
        $this->auth = $auth;
    }

    public function index () {
        $user = Auth::user();

        if ($user) { 
            $users = User::select('name', 'id')->where('id', '!=', $user->id)->get();
        } else {
            $users = User::select('name', 'id')->get();
        }

         return view('conversations.index', compact('users'));
        
        // return view('conversations.index', 
        //     [
        //         'users' => $this->conversationRepository->getConversations($this->auth->user()->id)
        //     ]
        // );
        
    }


    public function show (User $user) {
        $currentUser = Auth::user();

        $users = User::select('name', 'id')->where('id', '!=', $currentUser->id)->get();

        return view('conversations.show', compact('users', 'user'));

        
        // return view('conversations.show', 
        //     [
        //         'users' => $this->conversationRepository->getConversations($this->auth->user()->id),
        //         'user' => $user,
        //         'messages' => $this->conversationRepository->getMessagesFor($this->auth->user()->id, $user->id->get())
        //     ]
        // );

    }

    public function store (User $user, Request $request) { 
        $this->conversationRepository
            ->createMessage(
                $request->get('content'),
                $this->auth->user()->id,
                $user->id
            );

            return redirect(route('conversations.show', ['id' => $user->id]));
    }
 
}
