<?php
    //Functions for store clients and list them out
    namespace App\Controller;
    
    //homebrew
    use App\Entity\Client;
    
    //functional
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\Routing\Annotation\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    //for form
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Form\Extension\Core\Type\TextType;
    use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
    use Symfony\Component\Form\Extension\Core\Type\EmailType;
    use Symfony\Component\Form\Extension\Core\Type\SubmitType;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Constraints\Email;

    class ClientController extends AbstractController{
        /**
         * @Route("/", name="client_list"),methods={"GET"})
         */
        public function index(){
            //List out all clients
            $ClientList = $this->getDoctrine()->getRepository
            (Client::class)->findAll();
            return $this->render('Clients/index.html.twig', array('Clients' => $ClientList ) );
        }
        /**
         * @Route("/new"), methods={"GET", "POST"})
         */
        public function add(Request $request){
            //Add a new client
            $Client = new Client();
            $form = $this->createFormBuilder($Client)
                ->add('Firstname', TextType::class, [
                    'constraints' => [
                        new NotBlank()
                    ],
                ])
                ->add('Lastname', TextType::class, [
                    'constraints' => [
                        new NotBlank()
                    ],
                ])
                ->add('Birth', BirthdayType::class, [
                    'constraints' => [
                        new NotBlank()
                    ],
                ])
                ->add('Email', EmailType::class, [
                    'constraints' => [
                        new NotBlank(),
                        new Email()
                    ],
                ])
                ->add('Phone', TextType::class, [
                    'constraints' => [
                        new NotBlank()
                    ],
                ])
                ->add('save', SubmitType::class, ['label' => 'Save'])
                ->getForm();

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                
                //store to database
                $Client = $form->getData();
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($Client);
                $entityManager->flush();

                //redirect back to index
                return $this->redirectToRoute("client_list");
            }
            //get list
            $ClientList = $this->getDoctrine()->getRepository
            (Client::class)->findAll();
            //generate view
            return $this->render('Clients/new.html.twig', array('Form' => $form->createView(), 'Clients' => $ClientList ) );
        }
    }