@extends('dashboard.template')
@section('content')
    <div class="col m-5">
        <h3 class="mt-5 mb-5">Your access tokens</h3>
        <form action="{{ url('dashboard/settings/create-token') }}" method="POST">
            <div class="input-group mb-3">
                @csrf
                <input type="text" class="form-control rounded-start-2" name="name" placeholder="Token name"
                    aria-label="Token name" aria-describedby="button-addon2">
                <button class="btn btn-outline-success" type="submit" id="button-addon2">Create new</button>
            </div>
        </form>
        @if (session('createdToken'))
            <div class="alert alert-success mt-5 mb-5" role="alert">
                Here is your token. Please store it securely:
                <br />
                <b>{{ session('createdToken') }}</b>
            </div>
        @endif
        <table class="table table-bordered mt-5 text-center">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Last used at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($user->tokens as $token)
                    <tr>
                        <th scope="row">{{ $token->name }}</th>
                        <td>{{ $token->created_at }}</td>
                        <td>{{ $token->last_used_at }}</td>
                        <td>
                            <form method="POST" action={{ url('dashboard/settings/delete-token') }}>
                                @csrf
                                <input type="hidden" name="token_id" value={{ $token->id }}>
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <hr />
        <h3 class="mt-5 mb-5">Your webhook signature</h3>
        @if ($user->webhookSignature === null)
            <form action="{{ url('dashboard/settings/create-signature') }}" method="POST">
                <div class="input-group mb-3">
                    @csrf
                    <input type="text" class="form-control rounded-start-2" name="name" placeholder="Signature name"
                        aria-label="Signature name" aria-describedby="button-addon2">
                    <button class="btn btn-outline-success" type="submit" id="button-addon2">Create new</button>
                </div>
            </form>
        @endif
        @if (session('createdSignature'))
            <div class="alert alert-success mt-5 mb-5" role="alert">
                Here is your signature. Please store it securely:
                <br />
                <b>{{ session('createdSignature') }}</b>
            </div>
        @endif
        <table class="table table-bordered mt-5 text-center">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Value</th>
                    <th scope="col">Created at</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($user->webhookSignature)
                    <tr>
                        <th scope="row">{{ $user->webhookSignature->name }}</th>
                        <td>{{ $user->webhookSignature->value }}</td>
                        <td>{{ $user->webhookSignature->created_at }}</td>
                        <td>
                            <form method="POST" action={{ url('dashboard/settings/delete-signature') }}>
                                @csrf
                                <input type="hidden" name="signature_id" value={{ $user->webhookSignature->id }}>
                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
@endsection
