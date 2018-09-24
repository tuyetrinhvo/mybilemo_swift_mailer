<?php
/**
 * Class Doc Controller
 *
 * PHP version 7.0
 *
 * @category PHP_Class
 * @package  AppBundle
 * @author   trinhvo <ttvdep@gmail.com>
 * @license  License Name
 * @link     Link Name
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Form\Type\RegistrationType;

/**
 * Class DefaultController
 *
 * @category PHP_Class
 * @package  AppBundle\Controller
 * @author   trinhvo <ttvdep@gmail.com>
 * @license  License Name
 * @link     Link Name
 */
class DefaultController extends Controller
{
    /**
     * Function indexAction
     *
     * @Route("/",      name="homepage")
     * @Method({"GET"})
     * @return          \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * Function sendMailAction
     *
     */
    public function sendMailAction(Request $request, \Swift_Mailer $mailer)
    {

            $mail = \Swift_Message::newInstance()
                ->setSubject('Message depuis http://bilemo.ttvo.fr')
                ->setFrom('noreply@ttvo.fr')
                ->setTo('tuyetrinhvo@gmail.com')
                ->setBody(
                    'Information pour tester API bilemo : '.
                    '<br/>client_id : '.$client->getPublicId().
                    '<br/> client_secret : '.$client->getSecret()
                )
                ->setContentType('text/html');

            if ($mailer->send($mail)) {
                $this->addFlash('success', 'Le message a été bien envoyé.');

                return $this->redirectToRoute('fos_user_registration_register');
            }

            $this->addFlash('error', 'Le message n\'a pas été envoyé.');

            return $this->redirectToRoute('fos_user_registration_register');
        }


}
