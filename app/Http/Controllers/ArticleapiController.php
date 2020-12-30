<?php

namespace App\Http\Controllers;

use App\http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ArticleapiService as articleService;
use Illuminate\Support\Facades\Validator;

class ArticleapiController extends Controller {
	protected $articleService;

	public function __construct(ArticleService $articleService) {
		$this->articleService = $articleService;
	}

	public function index() {
		$article = $this->articleService->indexs();
		if (empty($article)) {
			return response()->json([
				'success' => false,
				'message' => '未有文章',
				'data' => '',
			], 400);
		} else {
			return response()->json([
				'success' => true,
				'message' => '取得文章列表成功',
				'data' => $article,
			], 200);
		}
	}

	public function store(Request $request) {
		$article = Validator::make($request->all(), [
			'title' => 'required|max:25',
			'content' => 'required|max:255',
		]);
		if ($article->fails()) {
			return response()->json([
				'success' => false,
				'message' => '新增文章不合格式',
				'data' => '',
			], 400);
		} else {
			$article = $this->articleService->stores($request->all());
			if (empty($article)) {
				return response()->json([
					'success' => false,
					'message' => '新增文章失敗',
					'data' => '',
				], 400);
			} else {
				return response()->json([
					'success' => true,
					'message' => '新增文章成功',
					'data' => $article,
				], 200);
			}
		}
	}

	public function show($id) {
		$article = $this->articleService->shows($id);
		if (empty($article)) {
			return response()->json([
				'success' => false,
				'message' => '無此文章',
				'data' => '',
			], 400);
		} else {
			return response()->json([
				'success' => true,
				'message' => '顯示文章成功',
				'data' => $article,
			], 200);
		}
	}

	public function update(Request $request, $id) {
		$article = Validator::make($request->all(), [
			'title' => 'required|max:25',
			'content' => 'required|max:255',
		]);
		if ($article->fails()) {
			return response()->json([
				'success' => false,
				'message' => '更新文章不合格式',
				'data' => '',
			], 400);
		} else {
			$article = $this->articleService->updates($request->all(), $id);
			if (empty($article)) {
				return response()->json([
					'success' => false,
					'message' => '更新文章失敗',
					'data' => '',
				], 400);
			} else {
				return response()->json([
					'success' => true,
					'message' => '更新文章成功',
					'data' => '',
				], 200);
			}
		}
	}

	public function destroy($id) {
		$article = $this->articleService->destroys($id);
		if (empty($article)) {
			return response()->json([
				'success' => false,
				'message' => '刪除文章失敗',
				'data' => '',
			], 400);
		} else {
			return response()->json([
				'success' => true,
				'message' => '刪除文章成功',
				'data' => '',
			], 200);
		}
	}
}
