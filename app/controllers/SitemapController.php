<?php

class SitemapController extends Controller {

    public function sitemap()
    {
        // create new sitemap object
        $sitemap = App::make("sitemap");

        // set cache (key (string), duration in minutes (Carbon|Datetime|int), turn on/off (boolean))
        // by default cache is disabled
        $sitemap->setCache('sitemap', 30);

        // check if there is cached sitemap and build new only if is not
        if (!$sitemap->isCached())
        {
            // add item to the sitemap (url, date, priority, freq)
            $sitemap->add(URL::to('/'), Config::get('cassini.public_profile_launch_date')->format('c'), '1.0', 'monthly');

            // TODO - don't show private profiles
            $profiles = Profile::publicPublished()->get();

            foreach ($profiles as $profile) {
                $sitemap->add(route('show_public_profile',[$profile->slug]), $profile->updated_at, '1.0', 'weekly');
            }
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return $sitemap->render('xml');
    }
}
