<?php


namespace App\Http\Controllers\Admin;


use App\Models\ClientStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\UpdateClientRequest;
use Illuminate\Auth\Access\Response;
use Gate;
use App\Models\Client;
use Illuminate\Http\Request;
class ClientController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }
    public function index()
    {

  //  abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clients = Client::all();

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {



        $statuses = ClientStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.clients.create', compact('statuses'));
    }

    public function store(Request $request)
    {

        $client = Client::create($request->all());

        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {



        $statuses = ClientStatus::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $client->load('status');

        return view('admin.clients.edit', compact('statuses', 'client'));
    }

    public function update(Request $request, Client $client)
    {
        $client->update($request->all());

        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {



        $client->load('status');

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {


        $client->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
