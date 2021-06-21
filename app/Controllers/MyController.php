<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

use CodeIgniter\Controller;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;
use Firebase\JWT\JWT;


/**
 * Description of MyController
 *
 * @author Yusda Helmani
 */
class MyController extends Controller
{
    protected $helpers = ['mylib', 'asset', 'enkripsi', 'cookie', 'form', 'cms', 'text', 'date'];

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        session();
    }

    function sessionAplikasi($kd_level, $kd_user)
    {
        $row = $this->M_Auth->find($kd_user);
        $data = array(
            'kd_user' => $kd_user,
            'kd_level' => $kd_level,
            'username' => $row['username'],
            'tahun' => date('Y'),
            'is_logined' => true
        );
        return $data;
    }

    function getTahun()
    {
        return $this->log['tahun'] ? $this->log['tahun'] : date('Y');
    }

    function validateTokenUser(){
        $authenticationHeader = $this->request->getServer('HTTP_AUTHORIZATION');
        $encodedToken = getJWTFromRequest($authenticationHeader);
        $key = \Config\Services::getSecretKey();
        $decodedToken = JWT::decode($encodedToken, $key, ['HS256']);
        return  $this->M_Auth->where(['username' => $decodedToken->username])->first();
    }

    public function sendEmail($title, $message, $email_to, $attachment = null)
    {
        $this->email->setFrom('eoffice.setdatapin@gmail.com');
        $this->email->setTo($email_to);
        $this->email->attach($attachment);
        $this->email->setSubject($title);
        $this->email->setMessage($message);
        if (!$this->email->send()) {
            return false;
        } else {
            return true;
        }
    }

    function generateQrCode($kode, $filename, $url)
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create($url)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(500)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $logo = Logo::create(ROOTPATH . '/assets/img/logo_kab.png')
            ->setResizeToWidth(150)
            ->setResizeToHeight(150);
        $label = Label::create($kode)
            ->setTextColor(new Color(0, 0, 0));
        $result = $writer->write($qrCode, $logo, $label);
        header('Content-Type: ' . $result->getMimeType());
        return $result->saveToFile($filename);
    }

    function printQrCode($url)
    {
        $writer = new PngWriter();
        $qrCode = QrCode::create($url)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow())
            ->setSize(500)
            ->setMargin(10)
            ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));
        $logo = Logo::create(ROOTPATH . '/assets/img/logo_kab.png')
            ->setResizeToWidth(150)
            ->setResizeToHeight(150);
        $result = $writer->write($qrCode, $logo);
        header('Content-Type: ' . $result->getMimeType());
        return $result->getDataUri();
    }

}
