# homelessjoan

http://homelessjoan.com

Aims to be an up-to-date directory of services and interventions - powered by twitter to keep the data relevant (@HomelessJoan)

The directory is aimed at help-givers (charities, public services) to find relevant referals for those at risk of becoming homeless, and to allow them to keep their offerings up to date.
* In the charity sector, funding starts and stops.
  * This means *keeping up to date with which services are available is tough.*
* Personal relationships are the primary method of discovering updates, rather than an official communication network.
* Different care services specialise in different clients
  * because knowledge and care needs to be personalised to the end-user
  * because the problem is so varied



# Our Vision

We believe it is far more effective to prevent homeless at the earliest possible point when life event sets someone on the path to homelessness. This is cheaper, less time consuming and ultimately more effective than helping someone once they have become homeless - dealing with the causes rather than the fallout.

# What we hacked

http://homelessjoan.com and the twitter account @HomelessJoan
Tweets to @homelessjoan (Offering care services) are displayed on http://homelessjoan.com
Services can be removed by tweeting “@HomelessJoan remove”

# Technical details

@HomelessJane is based on open-source technologies specifically selected to be easy to set up:

    PHP

then embedded within that:

    Symfony (Doctrine and Twig)
    SQLite
    Twitter Bootstrap

PHP (>5.4.0) includes an embedded web-server perfect for running all this on localhost.  That means to further develop this prototype, all you have to do is.

1. Checkout a working copy of the repo
git clone https://github.com/lightenna/homelessjoan.git
2. Run up the embedded web server
php bin/console server:start 127.0.0.1:8080
3. Visit the application in your browser
lynx localhost:8080


# To-do list

* Implement remove.  If a tweet contains the word "remove", hide all tweets from that user.  Some stub functions are partially implemented for this already.
* Setup local file-based SQLite DB for basic database/cache storage.  SQLite is recommended because it works well with Symfony/Doctrine and it's file-based so doesn't add anything to the complexity of the setup.  That's crucial for a fledgling open-source project that volunteers hack!
* Implement caching.  Currently we're hitting the Twitter API every page load.  This needs to be reduced to < 15 requests per 15 minutes to comply with the Twitter API rate limit.  I suggest caching, then refreshing the cache every 3 minutes, or rather the first page request after 3 minutes since the last cache clear.
* Show only the most recent tweet from each user.  That way if a user sends a "hello", "test test testing" or makes an error with the grammar of their tweet, they can simply edit or re-tweet.
* Gloss up the look and feel.  The directory is ultra-basic at the moment.  It could do with a face lift.

# Hoped next steps

* A directory of help services is created. With details of:
  * What help is offered
  * Who can access the help
  * Who to contact
* This directory is super easy to update
  * Largest focus on turning off unavailable services, so that the vulnerable don't have a negative experience from being turned away
* Caregivers can query the directory to find the relevant personalised services for their client
* Caregivers can see new services that are offered - so can spend less time advertising their own services



# Instructions

To turn on a service
Tweet from @alex: @homelessjoan runs a temporary housing service on Saturdays
Displays as
@alex runs a temporary housing service on Saturdays

To turn off a service
Tweet from @alex: @homelessjoan remove
<which hides the “@alex runs a temporary service…” tweet (currently all other service tweets by @alex)>


# Contacts

Please ping @alex_stanhope a tweet if you'd like to connect with someone from the previous hack team.
