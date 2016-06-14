<?php namespace freshwax\Http\Controllers;

use freshwax\Http\Requests;
use freshwax\Http\Controllers\Controller;
use freshwax\Http\Requests\TrackCreateFormRequest;

use Illuminate\Http\Request;

use freshwax\Models\Artist;
use freshwax\Models\Album;
use freshwax\Models\Track;

use View;
use Input;
use Redirect;
use Auth;

class TracksController extends Controller {

    public function __construct()
    {
        $this->middleware('auth:artist');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if(Auth::check() && Auth::user()->isadmin){
            $tracks = Track::all();
        } else {
            $tracks = Track::where('private', '=', 0)->get();
        }
        return View::make('tracks.index', compact('tracks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $artists = Artist::all();
        $albums = Album::all();
        return View::make('tracks.create', compact('artists','albums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(TrackCreateFormRequest $request)
    {
        $track = Track::create(Input::except('track'));

        if( Input::hasFile('track') ){
            $trackfile = Input::file('track');
            $track_path = public_path() . '/uploads/';
            $track_name = Input::get('name') . '.' . $trackfile->getClientOriginalExtension();
            $trackfile->move($track_path, $track_name);
            $track->path = '/uploads/' . Input::get('name');
        }

        if( !Input::has('private') ){
            $track->private = false;
        }

        if( Input::has('album_id') ){
            $track->album()->associate(Album::findOrFail($request->album_id));
        }


        $activeartist = Artist::where('active_profile', '=', 1)->first();
        $track->save();

        $track->artists()->attach($activeartist->id);


        return Redirect::route('tracks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $track = Track::findOrFail($id);
        return View::make('tracks.edit', compact('track'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    public function delete($id)
    {
        $track = Track::findOrFail($id);
        return View::make('tracks.delete', compact('track'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $track = Track::findOrFail($id);
        $track->delete();
        return $this->index();
    }

}
