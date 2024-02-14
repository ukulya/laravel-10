<?php

use App\Http\Controllers\Profile\AvatarController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    try{
    // return view('welcome');

    // 1. raw sql query

    // $usersSelect = DB::select('select * from users');
    // dd($usersSelect); // prints simple array
    // array:1 [▼ // routes/web.php:23
    // 0 => {#314 ▼
    // +"id": 1
    // +"name": "urkuiash"
    // +"email": "ukulya150992@gmail.com"
    // +"email_verified_at": null
    // +"password": "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje"
    // +"remember_token": "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf"
    // +"created_at": null
    // +"updated_at": null
    // }
    // ]

    // $user = DB::insert('insert into users (name,email,password) values (?,?,?)',['test','test@test.ru','password']);
    // dd($user); // true - created user

    // $usersSelectId1 = DB::select('select * from users where id=1');
    //dd($usersSelectId1);

    //$usersSelectEmailQueryWrong = DB::select('select * from users where email=ukulya150992@gmail.com');
    //dd($usersSelectEmailQueryWrong); // SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '@gmail.com' at line 1
    // it can say difference if ukulya150992@gmail.com is part of the query or the value for the field

    // we can use backticks
    //$usersSelectEmailQueryWrongBackTicks = DB::select('select * from users where email=`ukulya150992@gmail.com`');
    //dd($usersSelectEmailQueryWrongBackTicks); // column not found - it considers ukulya150992@gmail.com as column

    // $usersSelectEmailQueryRight = DB::select('select * from users where email=?',['ukulya150992@gmail.com']); // use bindings
    //dd($usersSelectEmailQueryRight); 

    //$users = DB::table('users');
    //$updateUser = DB::update('update users set email="abc@gmail.com" where id=6');

    //$updateUserBinding = DB::update('update users set email=? where id=?',["tabc@gmail.com",6]);
    //dd($updateUserBinding); // 1

    //$userDelete = DB::delete('delete from users where id=6');
    //dd($userDelete); // 1

    // 2. Query Builder

    $usersQueryBuilder = DB::table('users')->get();
    // dd($usersQueryBuilder); // prints collection of arrays - very powerfull - where you can perform various tasks
    // Illuminate\Support\Collection {#314 ▼ // routes/web.php:53
    // #items: array:1 [▼
    // 0 => {#318 ▼
    //   +"id": 1
    //   +"name": "urkuiash"
    //   +"email": "ukulya150992@gmail.com"
    //   +"email_verified_at": null
    //   +"password": "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje"
    //   +"remember_token": "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf"
    //   +"created_at": null
    //   +"updated_at": null
    // }
    // ]
    // #escapeWhenCastingToString: false
    // }

    // $usersQueryBuilderWhere = DB::table('users')->where('id',1);    
    // dd($usersQueryBuilderWhere); // 
    //     Illuminate\Database\Query\Builder {#315 ▼ // routes/web.php:85
    //   +connection: Illuminate\Database\MySqlConnection {#212 …24}
    //   +grammar: Illuminate\Database\Query\Grammars\MySqlGrammar {#213 …5}
    //   +processor: Illuminate\Database\Query\Processors\MySqlProcessor {#214}
    //   +bindings: array:9 [▼
    //     "select" => []
    //     "from" => []
    //     "join" => []
    //     "where" => array:1 [▼
    //       0 => 1
    //     ]
    //     "groupBy" => []
    //     "having" => []
    //     "order" => []
    //     "union" => []
    //     "unionOrder" => []
    //   ]
    //   +aggregate: null
    //   +columns: null
    //   +distinct: false
    //   +from: "users"
    //   +indexHint: null
    //   +joins: null
    //   +wheres: array:1 [▼
    //     0 => array:5 [▼
    //       "type" => "Basic"
    //       "column" => "id"
    //       "operator" => "="
    //       "value" => 1
    //       "boolean" => "and"
    //     ]
    //   ]
    //   +groups: null
    //   +havings: null
    //   +orders: null
    //   +limit: null
    //   +offset: null
    //   +unions: null
    //   +unionLimit: null
    //   +unionOffset: null
    //   +unionOrders: null
    //   +lock: null
    //   +beforeQueryCallbacks: []
    //   +operators: array:33 [▼
    //     0 => "="
    //     1 => "<"
    //     2 => ">"
    //     3 => "<="
    //     4 => ">="
    //     5 => "<>"
    //     6 => "!="
    //     7 => "<=>"
    //     8 => "like"
    //     9 => "like binary"
    //     10 => "not like"
    //     11 => "ilike"
    //     12 => "&"
    //     13 => "|"
    //     14 => "^"
    //     15 => "<<"
    //     16 => ">>"
    //     17 => "&~"
    //     18 => "is"
    //     19 => "is not"
    //     20 => "rlike"
    //     21 => "not rlike"
    //     22 => "regexp"
    //     23 => "not regexp"
    //     24 => "~"
    //     25 => "~*"
    //     26 => "!~"
    //     27 => "!~*"
    //     28 => "similar to"
    //     29 => "not similar to"
    //     30 => "not ilike"
    //     31 => "~~*"
    //     32 => "!~~*"
    //   ]
    //   +bitwiseOperators: array:6 [▼
    //     0 => "&"
    //     1 => "|"
    //     2 => "^"
    //     3 => "<<"
    //     4 => ">>"
    //     5 => "&~"
    //   ]
    //   +useWritePdo: false
    // }

    // $usersQueryBuilderWhereGet = DB::table('users')->where('id',1)->get();    
    // dd($usersQueryBuilderWhereGet);
    // Illuminate\Support\Collection {#314 ▼ // routes/web.php:175
    // #items: array:1 [▼
    // 0 => {#318 ▼
    //   +"id": 1
    //   +"name": "urkuiash"
    //   +"email": "ukulya150992@gmail.com"
    //   +"email_verified_at": null
    //   +"password": "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje"
    //   +"remember_token": "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf"
    //   +"created_at": null
    //   +"updated_at": null
    // }
    // ]
    #escapeWhenCastingToString: false
    // }

    // $usersQueryBuilderInsert = DB::table('users')->insert([
    //     'email'=>'test@test.com',
    //     'name'=>'test',
    //     'password'=>'test'
    // ]);
    // dd($usersQueryBuilderInsert); // true

    // $usersQueryBuilderInsertWrong = DB::table('users')->where('id',8)->update('id',2); // Argument #1 ($values) must be of type array, string given
    // dd($usersQueryBuilderInsertWrong);    

    // $usersQueryBuilderInsertRight = DB::table('users')->where('id',8)->update(['id'=>2]); // Column not found: 1054 Unknown column '0' in 'field list'
    // dd($usersQueryBuilderInsertRight);  

    // $usersQueryBuilderDelete = DB::table('users')->where('id',2)->delete();
    // dd($usersQueryBuilderDelete);

    // get first user - prints simple object
    // $usersQueryBuilderSimpleObjectFirst = DB::table('users')->first();
    // dd($usersQueryBuilderSimpleObjectFirst);   
    //     {#322 ▼ // routes/web.php:211
    //   +"id": 1
    //   +"name": "urkuiash"
    //   +"email": "ukulya150992@gmail.com"
    //   +"email_verified_at": null
    //   +"password": "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje"
    //   +"remember_token": "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf"
    //   +"created_at": null
    //   +"updated_at": null
    // } 

    // 2.1. fetch first user with id one
    // $usersQueryBuilderFetchFirstMethod = DB::table('users')->where('id',1)->first();
    // dd($usersQueryBuilderFetchFirstMethod);
    //     {#323 ▼ // routes/web.php:225
    //   +"id": 1
    //   +"name": "urkuiash"
    //   +"email": "ukulya150992@gmail.com"
    //   +"email_verified_at": null
    //   +"password": "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje"
    //   +"remember_token": "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf"
    //   +"created_at": null
    //   +"updated_at": null
    // }

    // 2.2. fetch first user with id one
    // $usersQueryBuilderFetchSecondMethod = DB::table('users')->find(1);
    // dd($usersQueryBuilderFetchSecondMethod);
    // {#323 ▼ // routes/web.php:239
    //   +"id": 1
    //   +"name": "urkuiash"
    //   +"email": "ukulya150992@gmail.com"
    //   +"email_verified_at": null
    //   +"password": "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje"
    //   +"remember_token": "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf"
    //   +"created_at": null
    //   +"updated_at": null
    // }

    // pluck - retrieve an Illuminate\Support\Collection instance containing the values of a single column
    // retrieve a collection of user titles:
    // $titles = DB::table('users')->pluck('name');
    // dd($titles);
    //     Illuminate\Support\Collection {#317 ▼ // routes/web.php:253
    //   #items: array:1 [▼
    //     0 => "urkuiash"
    //   ]
    //   #escapeWhenCastingToString: false
    // }
    // foreach ($titles as $title) {
    //     echo $title; // urkuiash
    // }

    // upsert
    // $userUpsertWrong = DB::table('users')->upsert(
    // [                                                                                   // values to insert or update
    //     ['name' => 'Oakland', 'email' => 'San@Diego.usa', 'password' => 'destination'],   
    //     ['departure' => 'Chicago', 'destination' => 'New York', 'price' => 150]
    // ], 
    // ['departure', 'destination'],                                                       // lists the column(s) that uniquely identify records within the associated table
    // ['price']                                                                           // array of columns that should be updated if a matching record already exists in the database:
    // );
    // dd($userUpsertWrong);

    // $userUpsertTooFewArgErr = DB::table('users')->upsert(
    // [                                                                                  
    //     ['name' => 'Oakland', 'email' => 'San@Diego.usa', 'password' => 'destination'],   
    // ]);
    // dd($userUpsertTooFewArgErr); // Too few arguments , 1 passed ,at least 2 expected

    // $userUpsertRight = DB::table('users')->upsert(
    // [                                                                                  
    //     ['name' => 'Oakland', 'email' => 'San@Diego.usa', 'password' => 'destination'],   
    // ],
    // []
    // );
    // dd($userUpsertRight); // 1

    // Chunking Results - work with thousands of database records
    // include use Illuminate\Support\Collection; - otherwise it won't work
    // $userChunk = DB::table('users')->orderBy('id')->chunk(1, function (Collection $users) {
    //     foreach ($users as $user) {
    //     echo '<pre>';
    //     print_r($user);
    //     echo '</pre>';
    //     }
    // });

    //     stdClass Object
    // (
    //     [id] => 1
    //     [name] => urkuiash
    //     [email] => ukulya150992@gmail.com
    //     [email_verified_at] => 
    //     [password] => $2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje
    //     [remember_token] => 7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf
    //     [created_at] => 
    //     [updated_at] => 
    // )
    // stdClass Object
    // (
    //     [id] => 9
    //     [name] => Oakland
    //     [email] => San@Diego.usa
    //     [email_verified_at] => 
    //     [password] => destination
    //     [remember_token] => 
    //     [created_at] => 
    //     [updated_at] => 
    // )

    // 3. Eloquent ORM - object-relational mapper (ORM) that makes it enjoyable to interact with your database. 
    // When using Eloquent, each database table has a corresponding "Model" that is used to interact with that table. 
    // In addition to retrieving records from the database table, Eloquent models allow you to insert, update, and delete records from the table as well.
    // import the Model you are going to use - use 

    // $userEloquentModel = User::where('id',1)->first();
    // dd($userEloquentModel);
    // App\Models\User {#655 ▼ // routes/web.php:331
    //   #connection: "mysql"
    //   #table: "users"
    //   #primaryKey: "id"
    //   #keyType: "int"
    //   +incrementing: true
    //   #with: []
    //   #withCount: []
    //   +preventsLazyLoading: false
    //   #perPage: 15
    //   +exists: true
    //   +wasRecentlyCreated: false
    //   #escapeWhenCastingToString: false
    //   #attributes: array:8 [▼
    //     "id" => 1
    //     "name" => "urkuiash"
    //     "email" => "ukulya150992@gmail.com"
    //     "email_verified_at" => null
    //     "password" => "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje"
    //     "remember_token" => "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf"
    //     "created_at" => null
    //     "updated_at" => null
    //   ]
    //   #original: array:8 [▼
    //     "id" => 1
    //     "name" => "urkuiash"
    //     "email" => "ukulya150992@gmail.com"
    //     "email_verified_at" => null
    //     "password" => "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje"
    //     "remember_token" => "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf"
    //     "created_at" => null
    //     "updated_at" => null
    //   ]
    //   #changes: []
    //   #casts: array:2 [▼
    //     "email_verified_at" => "datetime"
    //     "password" => "hashed"
    //   ]
    //   #classCastCache: []
    //   #attributeCastCache: []
    //   #dateFormat: null
    //   #appends: []
    //   #dispatchesEvents: []
    //   #observables: []
    //   #relations: []
    //   #touches: []
    //   +timestamps: true
    //   +usesUniqueIds: false
    //   #hidden: array:2 [▼
    //     0 => "password"
    //     1 => "remember_token"
    //   ]
    //   #visible: []
    //   #fillable: array:3 [▼
    //     0 => "name"
    //     1 => "email"
    //     2 => "password"
    //   ]
    //   #guarded: array:1 [▼
    //     0 => "*"
    //   ]
    //   #rememberTokenName: "remember_token"
    //   #accessToken: null
    // }

    // create User Model
        // $userModelCreate = User::create([
        //     'email' => 'ukulya150992@gmail.com',
        //     'name' => 'Urkuiash',
        //     'password' => '1234'
        // ]);
    //     dd($userModelCreate); 
    //     // instead of getting true or false - we get newly created Model
    //     App\Models\User {#321 ▼ // routes/web.php:403
    //   #connection: "mysql"
    //   #table: "users"
    //   #primaryKey: "id"
    //   #keyType: "int"
    //   +incrementing: true
    //   #with: []
    //   #withCount: []
    //   +preventsLazyLoading: false
    //   #perPage: 15
    //   +exists: true
    //   +wasRecentlyCreated: true
    //   #escapeWhenCastingToString: false
    //   #attributes: array:6 [▼
    //     "email" => "Model@test.com"
    //     "name" => "test"
    //     "password" => "$2y$12$RDSdekXL6YM9SGZff5IjvOt8Fcf.MbjnTAf/A6ozTv7SqCXETPGwW"
    //     "updated_at" => "2024-02-01 05:05:54"
    //     "created_at" => "2024-02-01 05:05:54"
    //     "id" => 12
    //   ]
    //   #original: array:6 [▶]
    //   #changes: []
    //   #casts: array:2 [▶]
    //   #classCastCache: []
    //   #attributeCastCache: []
    //   #dateFormat: null
    //   #appends: []
    //   #dispatchesEvents: []
    //   #observables: []
    //   #relations: []
    //   #touches: []
    //   +timestamps: true
    //   +usesUniqueIds: false
    //   #hidden: array:2 [▶]
    //   #visible: []
    //   #fillable: array:3 [▶]
    //   #guarded: array:1 [▶]
    //   #rememberTokenName: "remember_token"
    //   #accessToken: null
    // }    

    // $usersEloquentModel = User::get();
    // dd($usersEloquentModel);

    // update ORM
    // $userModelUpdate = User::where('id',9)->update(['id'=>2]); 
    // dd($userModelUpdate); // 1 // routes/web.php:452

    // $userModelUpdateGetWrong = User::where('id',2)->get();
    // $userModelUpdateGetWrong->update(['id'=>2]); 
    // dd($userModelUpdateGetWrong);  // Method Illuminate\Database\Eloquent\Collection::update does not exist.

    //     $userModelUpdateFirst = User::where('id',2)->first();
    //     $userModelUpdateFirst->update(['id'=>2]); 
    //     dd($userModelUpdateFirst);  
    //     App\Models\User {#1061 ▼ // routes/web.php:460
    //   #connection: "mysql"
    //   #table: "users"
    //   #primaryKey: "id"
    //   #keyType: "int"
    //   +incrementing: true
    //   #with: []
    //   #withCount: []
    //   +preventsLazyLoading: false
    //   #perPage: 15
    //   +exists: true
    //   +wasRecentlyCreated: false
    //   #escapeWhenCastingToString: false
    //   #attributes: array:8 [▶]
    //   #original: array:8 [▶]
    //   #changes: []
    //   #casts: array:2 [▶]
    //   #classCastCache: []
    //   #attributeCastCache: []
    //   #dateFormat: null
    //   #appends: []
    //   #dispatchesEvents: []
    //   #observables: []
    //   #relations: []
    //   #touches: []
    //   +timestamps: true
    //   +usesUniqueIds: false
    //   #hidden: array:2 [▶]
    //   #visible: []
    //   #fillable: array:3 [▶]
    //   #guarded: array:1 [▶]
    //   #rememberTokenName: "remember_token"
    //   #accessToken: null
    // }

    // $userModelUpdateFind = User::find(12);
    // $userModelUpdateFind->update(['id'=>3]); 
    // dd($userModelUpdateFind);  // did not work

    //     $userModelDelete = User::find(12);
    //     $userModelDelete->delete(); 
    //     dd($userModelDelete); // prints user we deleted
    // App\Models\User {#1061 ▼ // routes/web.php:502
    //   #connection: "mysql"
    //   #table: "users"
    //   #primaryKey: "id"
    //   #keyType: "int"
    //   +incrementing: true
    //   #with: []
    //   #withCount: []
    //   +preventsLazyLoading: false
    //   #perPage: 15
    //   +exists: false
    //   +wasRecentlyCreated: false
    //   #escapeWhenCastingToString: false
    //   #attributes: array:8 [▼
    //     "id" => 12
    //     "name" => "test"
    //     "email" => "Model@test.com"
    //     "email_verified_at" => null
    //     "password" => "$2y$12$RDSdekXL6YM9SGZff5IjvOt8Fcf.MbjnTAf/A6ozTv7SqCXETPGwW"
    //     "remember_token" => null
    //     "created_at" => "2024-02-01 05:05:54"
    //     "updated_at" => "2024-02-01 05:05:54"
    //   ]
    //   #original: array:8 [▶]
    //   #changes: []
    //   #casts: array:2 [▶]
    //   #classCastCache: []
    //   #attributeCastCache: []
    //   #dateFormat: null
    //   #appends: []
    //   #dispatchesEvents: []
    //   #observables: []
    //   #relations: []
    //   #touches: []
    //   +timestamps: true
    //   +usesUniqueIds: false
    //   #hidden: array:2 [▶]
    //   #visible: []
    //   #fillable: array:3 [▶]
    //   #guarded: array:1 [▶]
    //   #rememberTokenName: "remember_token"
    //   #accessToken: null
    // }

    // print user we deleted
    // $userModelPrintDeleted = User::find(12);
    // dd($userModelPrintDeleted); // null // routes/web.php:549

    //     // if you just need all the records and don't need any operations on them - then use all()
    // $usersAll = User::all();
    // dd($usersAll); 
    //     Illuminate\Database\Eloquent\Collection {#655 ▼ // routes/web.php:553
    //   #items: array:2 [▼
    //     0 => App\Models\User {#1273 ▶}
    //     1 => App\Models\User {#1274 ▶}
    //   ]
    //   #escapeWhenCastingToString: false
    // }

    // when creating user - encrypt password
//     $userPassEncrypt = User::create([
//         'name'=>'Encrypt',
//         'email'=>'encrypt@pass.word',
//         'password'=>bcrypt('password')
//     ]);
//     dd($userPassEncrypt);
//     App\Models\User {#327 ▼ // routes/web.php:568
//   #connection: "mysql"
//   #table: "users"
//   #primaryKey: "id"
//   #keyType: "int"
//   +incrementing: true
//   #with: []
//   #withCount: []
//   +preventsLazyLoading: false
//   #perPage: 15
//   +exists: true
//   +wasRecentlyCreated: true
//   #escapeWhenCastingToString: false
//   #attributes: array:6 [▼
//     "name" => "Encrypt"
//     "email" => "encrypt@pass.word"
//     "password" => "$2y$12$CLginiMtrb9od6YT39kGTu07H.xxKVu5E40mlZ0FVDZMdj5nv4use"
//     "updated_at" => "2024-02-01 06:40:28"
//     "created_at" => "2024-02-01 06:40:28"
//     "id" => 13
//   ]
//   #original: array:6 [▶]
//   #changes: []
//   #casts: array:2 [▶]
//   #classCastCache: []
//   #attributeCastCache: []
//   #dateFormat: null
//   #appends: []
//   #dispatchesEvents: []
//   #observables: []
//   #relations: []
//   #touches: []
//   +timestamps: true
//   +usesUniqueIds: false
//   #hidden: array:2 [▶]
//   #visible: []
//   #fillable: array:3 [▶]
//   #guarded: array:1 [▶]
//   #rememberTokenName: "remember_token"
//   #accessToken: null
// }

    // we can automate password encryption in Model - use mutators / casts - go to User Model
//     $userAutoEncryptPass = User::create([
//         'name'=>'Encrypt',
//         'email'=>'encryptAuto@pass.word',
//         'password'=>bcrypt('password')
//     ]);
//     dd($userAutoEncryptPass);
// App\Models\User {#328 ▼ // routes/web.php:618
//   #connection: "mysql"
//   #table: "users"
//   #primaryKey: "id"
//   #keyType: "int"
//   +incrementing: true
//   #with: []
//   #withCount: []
//   +preventsLazyLoading: false
//   #perPage: 15
//   +exists: true
//   +wasRecentlyCreated: true
//   #escapeWhenCastingToString: false
//   #attributes: array:6 [▼
//     "name" => "Encrypt"
//     "email" => "encryptAuto@pass.word"
//     "password" => "$2y$12$aQpckP3AIDJn7lmwHfW9N.xuf0odv9IZ4P64qcXCkuMeQmoRDxM9S"
//     "updated_at" => "2024-02-01 07:11:18"
//     "created_at" => "2024-02-01 07:11:18"
//     "id" => 14
//   ]
//   #original: array:6 [▶]
//   #changes: []
//   #casts: array:2 [▶]
//   #classCastCache: []
//   #attributeCastCache: []
//   #dateFormat: null
//   #appends: []
//   #dispatchesEvents: []
//   #observables: []
//   #relations: []
//   #touches: []
//   +timestamps: true
//   +usesUniqueIds: false
//   #hidden: array:2 [▶]
//   #visible: []
//   #fillable: array:3 [▶]
//   #guarded: array:1 [▶]
//   #rememberTokenName: "remember_token"
//   #accessToken: null
// }

    // mutator - takes / changes field and stores in DB - is used in Model like bcrypt

    // accessor - is reverse / opposite of mutator - gets the field and then changes something - is also used in Model

    // $userName = User::find(2);
    // dd($userName->name); // "Oakland" // routes/web.php:666

    // we want to get from DB name with UpperCase
    $userNameGetAccessorUppercase = User::find(2);
    // dd($userNameGetAccessorUppercase->name); // "Oakland" // routes/web.php:670 - doesn't work 

    // tinker -interacts with application
    // php artisan tinker - gets you to the shell
    // app(); // prints app info
    // press e for end
    // press q to quit
//  strtoupper('test');
// = "TEST"
// > $user = User::find(1);
// [!] Aliasing 'User' to 'App\Models\User' for this Tinker session.
// = App\Models\User {#6643
//     id: 1,
//     name: "urkuiash",
//     email: "ukulya150992@gmail.com",
//     avatar: null,
//     email_verified_at: null,
//     #password: "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje",
//     #remember_token: "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf",
//     created_at: null,
//     updated_at: null,
//   }

// > $user->avatar='avatar'; 
// = "avatar"

// > $user
// = App\Models\User {#7268
//     id: 1,
//     name: "urkuiash",
//     email: "ukulya150992@gmail.com",
//     avatar: "avatar",
//     email_verified_at: null,
//     #password: "$2y$10$8yjkbnUSHd.7MlPEA7RC5OLwWR/pXe2yp2kDG0RbHiEHNtEDRoYje",
//     #remember_token: "7OHMCE1CN85pOT5bYPDxIC511CsJGn0X1NrtBB86QqFSEyp18Oj3KPfqDyVf",
//     created_at: null,
//     updated_at: null,
//   }

// > 

// save to see DB uppdate
// > $user->save();
// = true

// use update statement

//  $user2 = User::find(2);
// = App\Models\User {#7262
//     id: 2,
//     name: "Oakland",
//     email: "San@Diego.usa",
//     avatar: null,
//     email_verified_at: null,
//     #password: "destination",
//     #remember_token: null,
//     created_at: null,
//     updated_at: "2024-02-01 05:16:08",
//   }

// > $user2->update(['avatar'=>'newavatar']);
// = true // in fact did not work // need to define this field to be fillable

// > $user2->update(['name'=>'newname']);
// = true // it worked

    // php artisan tinker
    // $user = User::find(1);
    // $user->avatar = "new value";

    // mass assignment
    // we can turn $fillable to guarded - oppposite of fillable
    // protected $guarded = []; // we dont want to restrict any user inputs
    // $user->avatar = "new value";

    // what if we want to assign value no matter the settings in Model
    // User::unguard();
    //  $user->update(['avatar'=>'new unguarded value']);
    // once we updated we need to reguard
    // User::reguard();

    // dd('dump and die');
}catch(Exception $e){
    return $e;
}
});
Route::view('/home', 'home');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/avatar', [AvatarController::class, 'update'])->name('profile.avatar'); // we're gonna name the route ->name('profile.avatar') , we shall use this name in forms and other blades - coz it will stay the same - route can change but if use name - then no need to replace it in the referrences
});

require __DIR__ . '/auth.php';
