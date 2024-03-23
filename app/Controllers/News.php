<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use App\Models\NewsModel;
class News extends BaseController
{
    public function index()
    {
        $model = model(NewsModel::class);
        $log_message = var_export($model, true);
        log_message('debug', $log_message);
        $data = [
            'news'  => $model->getNews(),
            'title' => 'News archive',
        ];

        return view('templates/header',$data)
            . view('news/index')
            . view('templates/footer');
    }

    public function show($seq = null)
    {
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($seq); // db조회

        if (empty($data['news'])) {
            throw new PageNotFoundException('Cannot find the news item: ' . $seq);
        }

        $data['title'] = $data['news']['TITLE']; // 실제 컬럼명 사용(대소문자 구분)

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }

//    public function del($seq = null) // 삭제하기 (DELETE처리)
//    {
//        helper('form');
//
//        $model = model(NewsModel::class);
//
//        $model->delete($seq);
//
//        return view('templates/header', ['title' => '삭제된 게시물 입니다.'])
//            . view('news/success_d')
//            . view('templates/footer');
//    }


    public function del($seq)
    {
        $model = model(NewsModel::class);

        // 특정 컬럼 값을 변경할 데이터 설정
        $data = [
            'USE_YN' => 'N',
        ];
        $datas = [
          'seq' => $seq,
          'USE_YN' => 'N',
        ];
        $model->save($datas);
        $msg = '삭제되었습니다.';

        $response = [
            'status' => 'success', // 성공 여부를 나타내는 상태
            'msg' => $msg // 메시지
        ];

// JSON 응답을 반환합니다.
        return $this->response->setJSON($response);
    }

    public function new()
    {
        helper('form');

        return view('templates/header',['title' => 'Create'])
            . view('news/create')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        $data = $this->request->getPost(['title','content']);

        if(!$this->validateData($data,[
            'title' => 'required|max_length[255]|min_length[3]',
            'content'  => 'required|max_length[5000]|min_length[10]',
        ])){
            return $this->new();
        }

        $post = $this->validator->getValidated();

        $model = model(NewsModel::class);

        $model->save([
            'TITLE' => $post['title'],
            'SLUG'  => url_title($post['title'],'-',true),
            'CONTENT' => $post['content'],
        ]);

        return view('templates/header', ['title' => 'Create a news item']) // header 파일의 $title 부분에 들어갈 데이터
            .view('news/success') // 뷰파일 로드 후 반환 성공시 넘어가는 페이지
            .view('templates/footer');
    }

    public function recreate($seq = null)
    {
        helper('form');
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($seq); // db조회

        $data['title'] = $data['news']['TITLE']; // 실제 컬럼명 사용(대소문자 구분)
        return view('templates/header',$data)
            . view('news/recreate')
            . view('templates/footer');
    }

    public function update($seq)
    {
        helper('form');

        $data = $this->request->getPost(['title','content']);

        if(!$this->validateData($data,[
            'title' => 'max_length[255]',
            'content'  => 'max_length[5000]',
        ])){
            return $this->recreate();
        }
        $post = $this->validator->getValidated();

        $model = model(NewsModel::class);

        $model->update($seq,[
            'TITLE' => $post['title'],
            'SLUG'  => url_title($post['title'],'-',true),
            'CONTENT' => $post['content'],
        ]);

        return view('templates/header', ['title' => 'Update a news item']) // header 파일의 $title 부분에 들어갈 데이터
            .view('news/success') // 뷰파일 로드 후 반환 성공시 넘어가는 페이지
            .view('templates/footer');
    }
}