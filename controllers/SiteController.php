<?php

namespace app\controllers;

use app\models\Article;
use app\models\Category;
use Yii;
use yii\data\Pagination;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

/**
 * Class SiteController
 * @package app\controllers
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $popularPosts = Article::getPopular();
        $recentPosts = Article::getRecent();
        $categories = Category::getAllWithArticles();

        $data = Article::getAllWithPagination(1);

        return $this->render('index', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popularPosts' => $popularPosts,
            'recentPosts' => $recentPosts,
            'categories' => $categories
        ]);
    }



    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $article = Article::findOne($id);
        $recentPosts = Article::getRecent();
        $popularPosts = Article::getPopular();
        $categories = Category::getAllWithArticles();
        return $this->render('single', compact('article', 'recentPosts', 'categories', 'popularPosts'));
    }

    /**
     * @param $id
     * @return string
     */
    public function actionCategory($id)
    {
        $data = Category::getArticlesByCategory($id);
        $popularPosts = Article::getPopular();
        $recentPosts = Article::getRecent();
        $categories = Category::getAllWithArticles();

//        $data = Article::getAllWithPagination(5);

        return $this->render('category', [
            'articles' => $data['articles'],
            'pagination' => $data['pagination'],
            'popularPosts' => $popularPosts,
            'recentPosts' => $recentPosts,
            'categories' => $categories
        ]);
    }
}
