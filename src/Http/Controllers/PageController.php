<?php

namespace Xcms\Page\Http\Controllers;

use Illuminate\Http\Request;
use Xcms\Base\Http\Controllers\SystemController;
use Xcms\Page\Models\Page;
use Xcms\Themes\Facades\ThemeFacade;

class PageController extends SystemController
{
    public function __construct()
    {
        parent::__construct();

        $this->middleware(function (Request $request, $next) {

            menu()->setActiveItem('pages');

            $this->breadcrumbs
                ->addLink('内容管理')
                ->addLink('页面列表', route('pages.index'));

            return $next($request);
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|string
     */
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            return Page::all()->toJson();
        }

        $this->setPageTitle('页面列表');

        return view('page::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->setPageTitle('添加页面');
        $this->breadcrumbs->addLink('添加页面');
        $templates = get_templates('pages');

        return view('page::create', compact('templates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $page = new Page();
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->input('editormd-html-code');
        $page->template = $request->template;
        $page->order = $request->order;

        $result = $page->save();
        if($result){
            return redirect()->route('pages.index')->with('success_msg','添加页面成功');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->setPageTitle('编辑页面');
        $page = Page::find($id);
        $templates = get_templates('pages');

        return view('page::edit', compact('page', 'templates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $page = Page::find($id);
        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->content = $request->input('editormd-html-code');
        $page->template = $request->template;
        $page->order = $request->order;

        $result = $page->save();
        if($result){
            return redirect()->route('pages.index')->with('success_msg','编辑页面成功');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Page::destroy($id);
        return response()->json(['code' => 200, 'message' => '删除页面成功']);
    }
}
