<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Business;
Use App\Posts_Status;
Use App\Posts_Requests;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use DB;

class PostController extends Controller
{
   public function index()
   {
        return (Auth::user()->type == 'company') ? view('auth/post') : view('/home') ;
   }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:55'],
            'prov' => ['required', 'string', 'max:55'],
            'postcode' => ['required', 'regex:/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/', 'min:6'],
            'datetimepicker' => ['required', 'date','after:1 days'],
            'datetimepicker1' => ['required', 'date','after:2 days'],
            'rate' => ['required','regex:/^(?=.+)(?:[1-9]\d*|0)?(?:\.\d+)?$/'],
            'description' => ['required', 'string', 'max:255'],
            'femaleGuards' => ['required','numeric','between:0,25'],
            'maleGuards' => ['required','numeric','between:0,25'],
            'height' => ['required', 'digits:3'],
            'weight' => ['required', 'digits:3'],
            'rating' => ['required', 'numeric','between:1,5'],
         ]);

        //dd($validatedData);
        $this->create($validatedData);
        return view('/home');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Post
     */
    protected function create(array $data)
    {
        return Post::create([
        'created_by' => Auth::user()->id,
        'description' => $data['description'],
        'rate' => $data['rate'],
        'street' => $data['address'],
        'city' => $data['city'],
        'prov' => $data['prov'],
        'postcode' => $data['postcode'],
        'security_rating' => $data['rating'],
        'height' => $data['height'],
        'weight' => $data['weight'],
        'female_guards' => $data['femaleGuards'],
        'male_guards' => $data['maleGuards'],
        'status' => 1,
        'start_date_time' => $data['datetimepicker'],
        'end_date_time' => $data['datetimepicker1'],
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /** Status Outline
     * 1 => Open
     * 2 => Requested
     * 3 => approved
     * 4 => booked
     * 5 => filled
     * 6 => cancelled
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function list()
    {
        if(Auth::user()->type == 'company')
        {
            $posts = Post::where('created_by', Auth::user()->id)
            ->addSelect(['company' => Business::select('company_name')
            ->whereColumn('created_by', 'user_id' ),
            'status' => Posts_Status::select('status')
            ->whereColumn('posts.status', 'posts__statuses.id')
            ->limit(1)
            ])->get();
        }else
        {
            $posts = Post::addSelect(['company' => Business::select('company_name')
            ->whereColumn('created_by', 'user_id' ),
            'status' => Posts_Status::select('status')
            ->whereColumn('posts.status', 'posts__statuses.id')
            ])
            ->orderby('id', 'desc')
            ->get();
        }


        return view('auth/post_list',['posts'=>$posts] );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_post_status(Request $request)
    {
        if($request->action == 'approve')
        {
            $recepient = User::where('id',$request->id)->first();
            request()->merge(['email' => $recepient->email]);

            Mail::raw('Approve Booking', function($message)
            {
                $message->to(request('email'))
                ->subject('Click Link to confirm booking');
            });
            //approved
            $post_status = 3;
        }
        else
        {
            $fillcount= Post::select(DB::raw('female_guards+male_guards as NOG'))
            ->where('id', $request->post_id)
            ->addSelect(['booked' => DB::table('posts__requests')
            ->addselect(DB::raw('count(`id`) as `booked`'))
            ->whereRaw('post_id = '. $request->post_id .' and status = 4')
            ])->first();

            if($fillcount['booked'] == $fillcount['NOG'])
            {
                $post_status = 5;
                //Update post to filled status when all positions are booked
                $post = Post::find($request->post_id);
                $post->status = 5;
                $post->save();
            }
            else
            {
                $post_status = 4;
            }

        }

        $affected = DB::table('posts__requests')
        ->where([['security_id', $request->id], ['post_id', $request->post_id],])
        ->update(['status' => $post_status]);

        return 'Post successfully updated';
    }

    public function details($id)
    {

        $post = Post::where('id', $id)
        ->addSelect(['booked' => Business::select(DB::raw('count(`id`) as `booked`'))
        ->whereColumn('created_by', 'user_id' ),
        'status' => Posts_Status::select('status')
        ->whereColumn('posts.status', 'posts__statuses.id')
        ])->first();

        $requestList = DB::table('posts__requests')
            ->join('securities', 'user_id', '=', 'security_id')
            ->select('securities.*','posts__requests.status' ,'posts__requests.post_id', 'posts__requests.security_id')
            ->where('posts__requests.post_id', $id)
            ->get();

        $female = DB::table('posts__requests')
            ->join('securities','user_id', '=', 'security_id')
            ->select(DB::raw('count(security_id) as `females`'))
            ->whereRaw('gender = "female" and status = 4 and post_id ='.$id)
            ->first();

        $male = DB::table('posts__requests')
            ->join('securities','user_id', '=', 'security_id')
            ->select(DB::raw('count(security_id) as `males`'))
            ->whereRaw('gender = "male" and status = 4 and post_id ='.$id)
            ->first();

        $booked = [$female,$male];

       return view('auth/post_details',['post'=>$post, 'requestList'=>$requestList, 'booked'=> $booked]);
    }

    public function pickUp(Request $request)
    {
        $post = Post::find($request->id);

        $post->status = 2;

        $post->save();

        $new_request = DB::table('posts__requests')->insert([
            ['post_id' => $request->id, 'security_id' => Auth::user()->id, 'status' =>2 ]
        ]);

        return  'Shift Successfully Requested';
    }

}
