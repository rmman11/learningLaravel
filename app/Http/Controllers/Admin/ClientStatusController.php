<?php

namespace App\Http\Controllers\Admin;
use App\Models\ClientStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientStatusRequest;
use App\Http\Requests\UpdateClientStatusRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ClientStatusController extends Controller
{
    public function index()
    {



        $clientStatuses = ClientStatus::all();

        return view('admin.clientStatuses.index', compact('clientStatuses'));
    }

    public function create()
    {

        return view('admin.clientStatuses.create');
    }

    public function store(Request $request)
    {



        $clientStatus = ClientStatus::create($request->all());

        return redirect()->route('admin.clientStatuses.index');
    }

    public function edit(ClientStatus $clientStatus)
    {

        return view('admin.clientStatuses.edit', compact('clientStatus'));
    }

    public function update(UpdateClientStatusRequest $request, ClientStatus $clientStatus)
    {
        $clientStatus->update($request->all());

        return redirect()->route('admin.client-statuses.index');
    }

    public function show(ClientStatus $clientStatus)
    {


        return view('admin.clientStatuses.show', compact('clientStatus'));
    }

    public function destroy(ClientStatus $clientStatus)
    {


        $clientStatus->delete();

        return back();
    }

    public function massDestroy(Request $request)
    {
        ClientStatus::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
