<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;

class ArticleService
{
	protected $articleRepository;

	public function __construct(ArticleRepository $articleRepository)
	{
		$this->articleRepository = $articleRepository;
	}

	public function indexService()
	{
		return $this->articleRepository->getIndex();
	}

	public function storeService(array $data)
	{
		return $this->articleRepository->getStore($data);
	}

	public function showService($id)
	{
		return $this->articleRepository->getShow($id);
	}

	public function editService($id)
	{
		return $this->articleRepository->getEdit($id);
	}

	public function updateService(array $data,$id)
	{
		return $this->articleRepository->getUpdate($data,$id);
	}
	public function deleteService($id)
	{
		return $this->articleRepository->getDestroy($id);
	}
}