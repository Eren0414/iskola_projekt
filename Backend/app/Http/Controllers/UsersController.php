<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUsersRequest;
use App\Http\Requests\StoreUsersRequest;
use App\Http\Requests\UpdateUsersRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class UsersController extends Controller
{
    public function login(LoginUsersRequest $request)
    {
        //Eltároljuk az adatokat változókba
        $email = $request->input(('email'));
        $password = $request->input(('password'));

        //Az email alapján megkeressük a usert
        $user = User::where('email', $email)->first();

        //Stimmel-e az email és a jelszó?
        if (!$user || !Hash::check($password, $password ? $user->password : '')) {
            return response()->json([
                'message' => 'invalid email or password',
                'data' => []
            ], 401);
        }

        //Jó az email és a jelszó
        //Kitöröljük az esetleges tokenjeit
        // $user->tokens()->delete();

        //itt adjuk az új tokent
        $token = $user->createToken('access')->plainTextToken;
        $user->token = $token;

        //visszaadjuk a usert, ami a tokent is tartalmazni fogja
        //A fejlécben elküldjük a httpOnly sütit
        $data = [
            'message' => 'ok',
            'data' => $user
        ];
        return response()
            ->json($data, options: JSON_UNESCAPED_UNICODE);

    }

    public function logout(Request $request)
    {
        // Minden tokent töröl (en nem jó, mert egy másik bejelntkezést is kivégez)
        //---------------------
        // // Az $request->user() segítségével hozzáférünk a bejelentkezett felhasználóhoz
        // $user = $request->user();

        // // Töröljük a felhasználó összes tokenjét
        // $user->tokens()->delete();

        // return response()->json(['message' => 'Successfully logged out']);


        //Egy mási módszer
        // Megkeresi a tokent és törli ---------------------
        $token = $request->bearerToken(); // Kivonjuk a bearer tokent a kérésből

        // Megkeressük a token modellt
        $personalAccessToken = PersonalAccessToken::findToken($token);

        if ($personalAccessToken) {
            $personalAccessToken->delete();
            $data = [
                'message' => 'ok',
                'data' => []
            ];
            
        } else {
            $data = [
                'message' => 'Token not found',
                'data' => []
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);


        // Egy másik módszer ---------------------
        // $request->user()->currentAccessToken()->delete();
        // return response()->json(['message' => 'Successfully logged out']);
    }

    //Visszaadja a usereket
    public function index()
    {
        $rows = User::all();
        $data = [
            'message' => 'ok',
            'data' => $rows
        ];
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }


    public function store(StoreUsersRequest $request)
    {
        $rows = User::where('email', $request['email'])
            ->get();
        if (count($rows)!=0) {
            # már van ilyen email
            $data = [
                'message' => 'This email alredy exists',
                'data' => [
                    'email' => $request['email']
                ]
            ];
        } else {
            # még nincs ilyen email
            $rows = User::create(attributes: $request->all());
            $data = [
                'message' => 'ok',
                'data' => $rows
            ];
        }
                    
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }

    public function show(int $id)
    {
        $row = User::find($id);

        if ($row) {
            $data = [
                'message' => 'ok',
                'data' => $row
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }

    public function update(UpdateUsersRequest $request,  $id)
    {
        $row = User::find($id);
        if ($row) {
            $rows = User::where('email', $request['email'])
            ->get();
            if (count($rows)!=0) {
                # már van ilyen email
                $data = [
                    'message' => 'This email alredy exists',
                    'data' => [
                        'email' => $request['email']
                    ]
                ];
            }else{
                //nincs még ilyen email
                $row->update($request->all());
                $data = [
                    'message' => 'ok',
                    'data' => $row
                ];
            }
        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options:JSON_UNESCAPED_UNICODE);
    }

    public function destroy(int $id)
    {
        $row = User::find($id);
        if ($row) {
            $row->delete();
            $data = [
                'message' => 'ok',
                'data' => [
                    'id' => $id
                ]
            ];
        } else {
            $data = [
                'message' => 'Not found',
                'data' => [
                    'id' => $id
                ]
            ];
        }
        return response()->json($data, options: JSON_UNESCAPED_UNICODE);
    }
}
