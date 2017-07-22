<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\DependencyInjection\TwitterAPIExchange;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $mentions = $this->getTwitterActivity();
        $this->substituteNames($mentions);
        $user_blacklist = $this->findRemovedUsers($mentions);
        $filtered_mentions = $this->filterMentionsByUser($user_blacklist, $mentions);
        // replace this example code with whatever you need
        return $this->render('AppBundle:front:index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')) . DIRECTORY_SEPARATOR,
            'mentions' => $filtered_mentions,
        ]);
    }

    //
    // Helpers
    //

    private function getTwitterActivity()
    {
        // hack settings in here for now
        $settings = array(
            'oauth_access_token' => "888708594635550721-iU9d9sJy7bY1s9IhAviyeeXxFAlK4Ia",
            'oauth_access_token_secret' => "2jxx9U5NbLqDDqxiDOUH4fiywmnz1tXey7zL9jYdZVsVQ",
            'consumer_key' => "8t5rHV5Js6SvEtcp0ViitjXcn",
            'consumer_secret' => "PgvMAbv915NbLpDA7SjxANnkjhB46AMM7JclTr145Nyp7zztvh"
        );
        // first request for mentions
        $url = 'https://api.twitter.com/1.1/statuses/mentions_timeline.json';
        $requestMethod = 'GET';
        $twitter = new TwitterAPIExchange($settings);
        $mentions = $twitter->buildOauth($url, $requestMethod)
            ->performRequest();
        // parse response
        $mentionsObject = json_decode($mentions);
        return $mentionsObject;
    }

    private function substituteNames(&$mentions)
    {
        foreach ($mentions as &$mention) {
            // substitute HomelessJoan
            $revised = str_ireplace('@HomelessJoan', $mention->user->name . ' (@' . $mention->user->screen_name . ')', $mention->text);
            $mention->text = $revised;
        }
    }

    private function findRemovedUsers($mentions)
    {

    }

    private function filterMentionsByUser($user_blacklist, $mentions)
    {
        return $mentions;
    }


}
