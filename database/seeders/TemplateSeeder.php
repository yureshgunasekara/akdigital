<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = array(
            array(
                'title' => 'Blog Titles', 
                'slug' => 'blog-titles', 
                'status' => 'active',
                'prompt' => "Generate minimum 10 titles for the following blog topic: '_details_'. Keep tone as like: '_tone_'. Translate them in: '_language_'",
                'category' => 'blog',
                'completion' => 'blog_titles', 
                'description' => 'Simplify your content creation process with our AI-powered blog title generator', 
                'access_plan' => 'Free', 
                'icon' => 'Blog'
            ), 
            array(
                'title' => 'Blog Ideas', 
                'slug' => 'blog-ideas', 
                'status' => 'active',
                'prompt' => "Follow these keywords: _keywords_. And generate ideas for a blog which will be about the following details: '_details_'. And for each blog generated blog ideas write section heading for that blog idea. Write the Blog Idea title first then point the related sections. Translate the whole generated text to: '_language_'",
                'category' => 'blog',
                'completion' => 'blog_ideas', 
                'description' => 'Generate a Wide Range of Engaging Blog Ideas with AI-Powered Writing Assistance', 
                'access_plan' => 'Standard', 
                'icon' => 'BlogIdea'
            ), 
            array(
                'title' => 'Blog Intros', 
                'slug' => 'blog-intros', 
                'status' => 'active',
                'prompt' => "Generate introduction for a blog which is titled '_title_' which will be about the following details: '_details_'. Translate the whole generated text to: '_language_'",
                'category' => 'blog',
                'completion' => 'blog_intros', 
                'description' => 'Transform Your Blogging Success with AI Blog Intros that Set the Tone, Build Trust', 
                'access_plan' => 'Premium', 
                'icon' => 'BlogIntro'
            ), 
            array(
                'title' => 'Blog Section', 
                'slug' => 'blog-section', 
                'status' => 'active',
                'prompt' => "Generate a blog for the title '_title_'. Contain the following subheadings '_subheadings_'. Translate the whole blog to '_language_'",
                'category' => 'blog',
                'completion' => 'blog_section', 
                'description' => 'Create Engaging and Well-Structured Blog Posts with Our Comprehensive Template', 
                'access_plan' => 'Free', 
                'icon' => 'Blog'
            ), 
            array(
                'title' => 'Blog Conclusion', 
                'slug' => 'blog-conclusion', 
                'status' => 'active',
                'prompt' => "Generate conclusion for a blog which is titled '_title_' which will be about the following details: '_details_'. Translate the whole generated text to: '_language_'",
                'category' => 'blog',
                'completion' => 'blog_conclusion', 
                'description' => 'Craft Powerful and Memorable Blog Conclusion with AI Writing Assistance', 
                'access_plan' => 'Standard', 
                'icon' => 'Conclusion'
            ), 
            array(
                'title' => 'Summarize Text', 
                'slug' => 'summarize-text', 
                'status' => 'active',
                'prompt' => "Summarize the following text: '_details_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'text',
                'completion' => 'summarize_text', 
                'description' => 'Effortlessly Summarize Long Texts and Save Time with Our Powerful Template', 
                'access_plan' => 'Premium', 
                'icon' => 'SummarizeText'
            ), 
            array(
                'title' => 'Startup Name Idea', 
                'slug' => 'startup-name-idea', 
                'status' => 'active',
                'prompt' => "Generate 10 startup company names considering the given words '_word_seeds_' and follow the following description: '_details_'. Keep tone as like: '_tone_'. Translate the whole generated text to: '_language_'",
                'category' => 'idea',
                'completion' => 'startup_name_idea', 
                'description' => 'Generate Catchy and Memorable Startup Names with AI Technology.', 
                'access_plan' => 'Free', 
                'icon' => 'Startup'
            ), 
            array(
                'title' => 'Testimonial/Reviews', 
                'slug' => 'testimonial-reviews', 
                'status' => 'active',
                'prompt' => "generate 5 testimonials or reviews from demo customers for a product which is called: '_name_'. The details of the product is the following: '_details_'. Keep a '_tone_' tone. Finally translate the whole generated texts in: '_language_'",
                'category' => 'text',
                'completion' => 'testimonial_reviews', 
                'description' => 'Generate Authentic and Engaging Reviews with AI Writing Assistance', 
                'access_plan' => 'Standard', 
                'icon' => 'Review'
            ), 
            array(
                'title' => 'YouTube Tag Idea', 
                'slug' => 'youtube-tag-idea', 
                'status' => 'active',
                'prompt' => "Generate tags for youtube considering the title of the video: '_title_'. Also generate some keywords for the video. Keep a '_tone_' tone. Translate the whole generated text in '_language_'",
                'category' => 'social',
                'completion' => 'youtube_tag_idea', 
                'description' => 'Generate Effective and Relevant Tags with AI-Powered Writing Assistance', 
                'access_plan' => 'Premium', 
                'icon' => 'YouTube'
            ), 
            array(
                'title' => 'Video Titles', 
                'slug' => 'video-titles', 
                'status' => 'active',
                'prompt' => "Generate 10 titles for the video considering the following details of the video: '_details_'. Keep a '_tone_' tone. Translate the whole generated text in '_language_'",
                'category' => 'video',
                'completion' => 'video_titles', 
                'description' => 'Engage Your Audience & Boost Your Views with a Captivating Video Title.', 
                'access_plan' => 'Free', 
                'icon' => 'Video'
            ), 
            array(
                'title' => 'Video Description', 
                'slug' => 'video-description', 
                'status' => 'active',
                'prompt' => "Generate description for the video considering the title of the video: '_title_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'video',
                'completion' => 'video_description', 
                'description' => 'Generate Authentic and Engaging Reviews with AI Writing Assistance', 
                'access_plan' => 'Standard', 
                'icon' => 'Video'
            ), 
            array(
                'title' => 'Instagram Captions', 
                'slug' => 'instagram-captions', 
                'status' => 'active',
                'prompt' => "Generate 10 instagram captions for the following post: '_details_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'social',
                'completion' => 'instagram_captions', 
                'description' => 'Maximize Your Reach and Engagement on Instagram with Eye-Catching Captions', 
                'access_plan' => 'Premium', 
                'icon' => 'Instagram'
            ), 
            array(
                'title' => 'Instagram #tag Idea', 
                'slug' => 'instagram-hashtag-idea', 
                'status' => 'active',
                'prompt' => "Generate 10 instagram hashtags considering the keyword: '_keyword_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'social',
                'completion' => 'instagram_hashtag_idea', 
                'description' => 'Transform Your Instagram Posts into a Discoverable Work of Art with Our #tag Idea Template', 
                'access_plan' => 'Free', 
                'icon' => 'Hashtag'
            ), 
            array(
                'title' => 'Social Media Post (Personal)', 
                'slug' => 'social-media-post-personal', 
                'status' => 'active',
                'prompt' => "Generate a social media post considering the following statement: '_details_'. Keep a '_tone_' tone. This will be posted from a personal account. Translate the whole generated text to: '_language_'",
                'category' => 'social',
                'completion' => 'social_media_post_personal', 
                'description' => 'Unlock Your Creativity and Create Compelling Social Media Posts', 
                'access_plan' => 'Standard', 
                'icon' => 'SocialMedia'
            ), 
            array(
                'title' => 'Social Media Post (Business)', 
                'slug' => 'social-media-post-business', 
                'status' => 'active',
                'prompt' => "Generate a social media post for the company which is called: '_company_name_'. Keep a '_tone_' tone. Following is the description of the company: '_company_details_'. Generate the social media post which will be about the following description: '_post_details_'. Translate the whole generated text to: '_language_'",
                'category' => 'social',
                'completion' => 'social_media_post_business', 
                'description' => 'Maximizing Your Social Media Engagement with AI-Generated Captions and Posts', 
                'access_plan' => 'Premium', 
                'icon' => 'SocialMedia'
            ), 
            array(
                'title' => 'Facebook Captions', 
                'slug' => 'facebook-captions', 
                'status' => 'active',
                'prompt' => "Generate 10 facebook captions for the following post: '_details_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'social',
                'completion' => 'facebook_captions', 
                'description' => 'Maximize Your Facebook Presence with Captivating Captions Using Our Template', 
                'access_plan' => 'Free', 
                'icon' => 'Facebook'
            ), 
            array(
                'title' => 'Facebook Ads', 
                'slug' => 'facebook-ads', 
                'status' => 'active',
                'prompt' => "Generate facebook advertisement for the product called: '_name_'. Which will be for: '_audience_'. The description of the product is the following: '_details_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'social',
                'completion' => 'facebook_ads', 
                'description' => 'Generate High-Impact Facebook Ads with AI-Powered Writing Assistance', 
                'access_plan' => 'Standard', 
                'icon' => 'Facebook'
            ), 
            array(
                'title' => 'Google Ads Titles', 
                'slug' => 'google-ads-titles', 
                'status' => 'active',
                'prompt' => "Generate 10 headlines for a google ad for the following product which is called: '_name_'. This product is intended for the following audience: '_audience_'. The details of the product is the following: '_details_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'social',
                'completion' => 'google_ads_titles', 
                'description' => 'Stand Out on Google and Drive Conversions with Engaging Ads Titles Using Our Template', 
                'access_plan' => 'Premium', 
                'icon' => 'GoogleAds'
            ), 
            array(
                'title' => 'Google Ads Details', 
                'slug' => 'google-ads-details', 
                'status' => 'active',
                'prompt' => "Generate description for a google ad for the following product which is called: '_name_'. This product is intended for the following audience: '_audience_'. The details of the product is the following: '_details_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'social',
                'completion' => 'google_ads_details', 
                'description' => 'Generate Authentic and Engaging Reviews with AI Writing Assistance', 
                'access_plan' => 'Free', 
                'icon' => 'GoogleAdsDetails'
            ), 
            array(
                'title' => 'Article Generator', 
                'slug' => 'article-generator', 
                'status' => 'active',
                'prompt' => "Write an article on the title '_title_' having the keywords '_keywords_'. Keep tone as like: '_tone_'. Translate the generated article in '_language_'",
                'category' => 'blog',
                'completion' => 'article_generator', 
                'description' => 'Effortlessly Summarize Long Texts and Save Time with Our Powerful Template', 
                'access_plan' => 'Standard', 
                'icon' => 'ArticleGenerator'
            ), 
            array(
                'title' => 'Content Re-writer', 
                'slug' => 'content-re-writer', 
                'status' => 'active',
                'prompt' => "Rewrite the following content: '_details_'. Keep a '_tone_' tone.Translate the whole generate text to: '_language_'",
                'category' => 'text',
                'completion' => 'content_re_writer', 
                'description' => 'Revitalizing Your Text with Innovative Language and Unique Perspective', 
                'access_plan' => 'Premium', 
                'icon' => 'ContentReWriter'
            ), 
            array(
                'title' => 'Paragraph Generator', 
                'slug' => 'paragraph-generator', 
                'status' => 'active',
                'prompt' => "Generate a paragraph considering the following description: '_details_'. Remember to keep focus on the following keywords: '_keywords_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'text',
                'completion' => 'paragraph_generator', 
                'description' => 'Unlocking the Power of Paragraphs for Engaging and Informative Content', 
                'access_plan' => 'Free', 
                'icon' => 'ParagraphGenerator'
            ), 
            array(
                'title' => 'Talking Points', 
                'slug' => 'talking-points', 
                'status' => 'active',
                'prompt' => "Generate 10 points considering the following description: '_details_'. Remember to keep focus that the description is about the following article: '_title_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'discussion',
                'completion' => 'talking_points', 
                'description' => 'Facilitating Your Communication with Pre-Written Scripts and Conversation Starters', 
                'access_plan' => 'Standard', 
                'icon' => 'TalkingPoints'
            ), 
            array(
                'title' => 'Pros & Cons', 
                'slug' => 'pros-cons', 
                'status' => 'active',
                'prompt' => "Generate 5 pros and 5 cons for the following product: '_title_'. The description of the product is the following: '_details_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'discussion',
                'completion' => 'pros_cons', 
                'description' => 'Weighing the Advantages and Disadvantages of Any Topic with AI-Generated Analysis', 
                'access_plan' => 'Premium', 
                'icon' => 'ProsCons'
            ), 
            array(
                'title' => 'Product Name Idea', 
                'slug' => 'product-name-idea', 
                'status' => 'active',
                'prompt' => "Generate product name for the following product considering the following description: '_details_'. Keep the generated product name relevant to the following words: '_words_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'idea',
                'completion' => 'product_name_idea', 
                'description' => 'Innovative AI-Generated Product Naming for Your Brand\'s Success', 
                'access_plan' => 'Free', 
                'icon' => 'ProductName'
            ), 
            array(
                'title' => 'Product Description', 
                'slug' => 'product-description', 
                'status' => 'active',
                'prompt' => "Write a description for the following product which is called: '_name_'. Which is for: '_audience_'. Consider the following description: '_details_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'other',
                'completion' => 'product_description', 
                'description' => 'Captivating Your Customers with Convincing and Informative Product Descriptions', 
                'access_plan' => 'Standard', 
                'icon' => 'ProductDescription'
            ), 
            array(
                'title' => 'Meta Description', 
                'slug' => 'meta-description', 
                'status' => 'active',
                'prompt' => "Generate meta description for a website which is called: '_name_'. The description of the website is the following: '_description_'. Consider the following keywords when generating meta description: '_keywords_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'other',
                'completion' => 'meta_description', 
                'description' => 'Boosting Your SEO and Click-Through Rates with AI-Generated Meta Descriptions', 
                'access_plan' => 'Premium', 
                'icon' => 'MetaDescription'
            ), 
            array(
                'title' => 'FAQs', 
                'slug' => 'faqs', 
                'status' => 'active',
                'prompt' => "Generate 10 questions for faq section for a website which is called: '_name_'. The description of the website is the following: '_description_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'faq',
                'completion' => 'faqs', 
                'description' => 'Delivering Comprehensive Answers to Common Questions with AI-Powered FAQs', 
                'access_plan' => 'Free', 
                'icon' => 'FAQs'
            ), 
            array(
                'title' => 'FAQ Answers', 
                'slug' => 'faq-answers', 
                'status' => 'active',
                'prompt' => "Generate 5 answers for the follwoing faq question: '_question_' The faq question belongs to the website which is called: '_name_'. The description of the website is the following: '_description_'. Keep a '_tone_' tone. Translate the whole generated text to: '_language_'",
                'category' => 'faq',
                'completion' => 'faq_answers', 
                'description' => 'Providing Expert Responses to Common Questions with AI-Generated FAQ Answers', 
                'access_plan' => 'Standard', 
                'icon' => 'FAQsAnswer'
            ), 
            array(
                'title' => 'Problem Agitate Solution', 
                'slug' => 'problem-agitate-solution', 
                'status' => 'active',
                'prompt' => "Our product is called: '_name_'. This product is suitable for: '_audience_'. The description of the product is the following: '_details_'. Generate a relevant problem and a relevant agitate and generate a solution that will focus towards the product. Keep a '_tone_' tone. Translate the whole generated text in '_language_'",
                'category' => 'other',
                'completion' => 'problem_agitate_solution', 
                'description' => 'Driving Conversions with Compelling Problem-Agitate-Solution Messaging', 
                'access_plan' => 'Premium', 
                'icon' => 'ProblemAgitateSolution'
            )
        );

        foreach($templates as $template){
            Template::create([
                'title' => $template['title'],
                'slug' => $template['slug'],
                'status' => 'active',
                'prompt' => $template['prompt'],
                'category' => $template['category'],
                'description' => $template['description'],
                'access_plan' => $template['access_plan'],
                'icon' => $template['icon'],
            ]);
        }
    }
}
