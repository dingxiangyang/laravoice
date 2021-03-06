<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Yajra\Datatables\Datatables;

/**
 * Class ClientController
 * @package App\Http\Controllers
 */
class ClientController extends Controller
{

    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * ClientController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * Get all Contacts
     *
     * @return string
     */
    public function index(User $user)
    {
        $clients = $user->all();
        return view('app.client.index', compact('clients'));
    }

    public function indexDatatable(User $user)
    {
        return $user->all();
    }

    /**
     * Show the Contact related to the given $id
     *
     * @param $id
     * @param User $user
     * @return User
     */
    public function show($id, User $user)
    {
        $user = $user->findOrFail($id);
        return $user;
    }

    /**
     * Store the Client with the given Inputs and
     * fire a Flash Message
     *
     * @param Request $request
     * @return static
     */
    public function store(Request $request)
    {
        $this->user->create($request->all());

        $request->session()->flash('success', trans('app/client/create.flash-success'));

        return redirect()->route('client.index');

    }

    /**
     * @param Request $request
     * @param $id
     */
    public function edit(Request $request, $id)
    {

    }
}
