<?php

namespace App\Http\Controllers;

use App\Main;
use App\Http\Requests\MainRequest;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $main = Main::get();
        return view('main', compact('main'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        $number = $this->generate();
        Main::create([
            'number' => $number]);
        return redirect()->route('main.index')->with('success', 'Вы сгенерировали номер');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Main  $main
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //dump($id);
        $number = Main::find($id);
        return view('main', compact('number'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Main  $main
     * @return \Illuminate\Http\Response
     */
    public function update(MainRequest $request, $id)
    {
        $main = Main::findOrFail($id);
        $main->update($request->all());
        return $main;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  MainRequest  $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(MainRequest $request, $id)
    {
        $main = Main::findOrFail($id);
        if($main->delete()) return response(null, 204);
    }

    public function generate()
    {
        function isprime($n){
            if($n==1)
                return false;
            // перебираем возможные делители от 2 до sqrt(n)
            for($d=2; $d*$d<=$n; $d++){
                // если разделилось нацело, то составное
                if($n%$d==0)
                    return false;
            }
            // если нет нетривиальных делителей, то простое
            return true;
        }
        $n = random_int(1,10000);
        if (isprime($n) === false){
            $number = $n;
        } else {
            if($n==1) $n++;
            $number = $n+1;
        }

        return $number; //дальше это число переходит в store()
    }
    public function retrieve($id){
        //вместо этой функции используется show()
    }
}
