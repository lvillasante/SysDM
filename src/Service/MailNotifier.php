<?php
namespace App\Service;

class MailNotifier
{
    protected $mailer;

    private $from = 'info@negociosvirtual.com';
    private $templating;

    public function __construct(\Swift_Mailer $mailer, \Twig\Environment $templating)
    {
        $this->mailer       = $mailer;
        $this->templating   = $templating;
    }

    public function notifierMail($subject, $to, $tipoPago="",$detallePago="", $user="",$password="",$urlAccess="",$nameFile="notificacion",$dataContact=[]):bool {
        $subjectMain=$subject;
        set_time_limit(0);
        $toMail=is_array($to)? $to[0]:$to;
        $nameFile="notificacion";
        if(is_array($to)){
            $toCc=$to[1]; 
            $message = (new \Swift_Message(''))
            ->setSubject($subjectMain)
            ->setFrom($this->from)
            ->setTo($toMail)
            ->setBcc($toCc)
            ->setBody(
                $this->templating->render(
                    // templates/emails/registration.html.twig
                    'emails/'.$nameFile.'.html.twig',
                    [
                        'tipoPago' => $tipoPago,
                        'detallePago' => $detallePago,
                        'user' => $user,
                        'password' => $password,
                        'urlAccess' => $urlAccess,
                        'from'=>$this->from,
                        'dataContact'=>$dataContact
                    ]
                ),
                'text/html'
            );
        }else{
            $message = (new \Swift_Message(''))
            ->setSubject($subjectMain)
            ->setFrom($this->from)
            ->setTo($toMail)
            ->setBody(
                $this->templating->render(
                    // templates/emails/registration.html.twig
                    'emails/'.$nameFile.'.html.twig',
                    [
                        'tipoPago' => $tipoPago,
                        'detallePago' => $detallePago,
                        'user' => $user,
                        'password' => $password,
                        'urlAccess' => $urlAccess,
                        'from'=>$this->from,
                        'dataContact'=>$dataContact
                    ]
                ),
                'text/html'
            );
        }
        
        ;
        return $this->mailer->send($message);
        //$this->serviceContainer->get('mailer')->send($message);
    }

    /**
     * Sets the sales order exporter object
     * @param type $serviceContainer
     */
    public function setServiceContainer($serviceContainer)
    {
        $this->serviceContainer = $serviceContainer;
    }
}