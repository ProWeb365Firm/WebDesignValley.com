Web Design Valley - static HTML version
=======================================

Upload the CONTENTS of this folder (including the hidden .htaccess file) to the web root of
webdesignvalley.com, or to any subfolder for a staging preview. All links are relative.

All 26 page URLs are unchanged (home, about-us, services and each service page, Rochester web
design, website design cost, web hosting, marketing, contact-us, and the blog with its 9 posts
and date archive). Each URL is a folder containing index.html.
/the-new-commerce-blueprint-dominating-ai-search-through-strategic-content-and-design/ still
redirects to the post's /blog/... address, as on the live site.

Contact form
------------
The Contact Form 7 form (on 7 pages) now posts to send.php (needs PHP) and shows the
usual "Thank you for your message" after sending. Messages go to info@webdesignvalley.com
(the address shown on the site); change $to in send.php to use another address.
The Cloudflare Turnstile box only works on webdesignvalley.com itself, so on a staging domain
it may show an error; forms still send either way.

Noindex (staging)
-----------------
Every page has <meta name="robots" content="noindex, nofollow" /> and .htaccess sends an
X-Robots-Tag: noindex, nofollow header, so search engines will not index this copy.
BEFORE GOING LIVE on the real domain: remove that meta line from each page and delete the
"BEGIN noindex ... END noindex" block from .htaccess, or the site will drop out of Google.
