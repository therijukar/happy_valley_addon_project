<?php

namespace app\controllers;

class CmsController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('index');
    }

    public function actionRestaurant()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('restaurant');
    }

    public function actionBanquet()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('banquet');
    }
    
    public function actionWaterworld()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('waterworld');
    }

    public function actionPicnicSpots()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('picnicSpots');
    }

    public function actionTheatre()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('theatre');
    }

    public function actionEvents()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('events');
    }

    public function actionContact()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'contactLayout';
	    return $this->render('contact');
    }

    // Functions For rides & slides

    public function actionStrikingCar()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('strikingCar');
    }

    public function actionBoating()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('boating');
    }

    public function actionChildrenBoating()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('childrenBoating');
    }

    public function actionChildrenPool()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('childrenPool');
    }

    public function actionHappyBees()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('happyBees');
    }

    public function actionJumpingHouse()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('jumpingHouse');
    }

    public function actionHorseTrain()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('horseTrain');
    }

    public function actionGaming()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('gaming');
    }

    public function actionPrivacy()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('privacy');
    }

    public function actionTerms()
    {
    	$this->view->title = 'Happy Valley Park';
        $this->layout = 'index';
	    return $this->render('terms');
    }

}
