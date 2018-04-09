<?php
    /**
     * Created by PhpStorm.
     * User: andrey
     * Date: 08.04.18
     * Time: 11:41
     */

    namespace AppBundle\Controller;


    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
    use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\HttpFoundation\Response;

    class PagesController extends Controller
    {

        /**
         * @Route("/")
         *
         */

        public function showAction()

        {
            //$category=['Происшествия', 'Спорт', 'Экономика', 'Политика', 'Технологии', 'Мир', 'Наука'];

            $em = $this->getDoctrine()->getManager();
            $category=$em->getRepository('AppBundle:Category')->findAll();



            for ($i=0;$i<count($category);$i++) {
                $em = $this->getDoctrine()->getManager();
                $news[$i] = $em->getRepository('AppBundle:News')->findFiveRecent($category[$i]);

            }


            return $this->render('news/show.main.twig',[
                'news1'=>$news[0],
                'news2'=>$news[1],
                'news3'=>$news[2],
                'news4'=>$news[3],
                'news5'=>$news[4],
                'news6'=>$news[5],
                'news7'=>$news[6]

            ]);


        }


        /**
         * @Route("/{category}", name="categories",requirements={
         *     "category":"accidents|sport|economics|politics|technology|world|science"}))
         */

        public function showCategoryAction($category)
        {

            return $this->render('news/show.category.twig',[
                'category'=>$category,
            ]);


        }




        /**
         * @Route("/{category}/{newsID}", name="news_description", requirements={
         *     "category":"accidents|sport|economics|politics|technology|world|science",
         *     "newsID": "\d+"})
         *
         */
        public function showSingleNewsAction($category,$newsID)
        {

            return $this->render('news/show.news.twig',[
                'category'=>$category,
                'newsID'=>$newsID
            ]);
        }




    }