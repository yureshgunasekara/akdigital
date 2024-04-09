<?php

namespace Database\Seeders;

use App\Models\ChildSection;
use App\Models\ChildSectionLink;
use App\Models\IntroSection;
use App\Models\IntroSectionChild;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntroPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $intro_sections = [
            [
                'type' => 'header',
                'title' => 'THE MOST POWERFUL AI WRITER',
                'subtitle' => 'Generate SEO-Optimized Content on Autopilot with our FastAI Template',
                'description' => 'Discover Our AI-Driven Website Template for Scalable, High-Quality Content Creation and Take Your Business to the Next Level',
                'asset' => 'assets/video/introduction-video.mp4',
                'children' => [
                    [
                        'title' => '✓ Free to try ✓ 2 min sign up · 5-day 100% money back guarantee',
                        'subtitle' => null,
                        'description' => null,
                        'image' => 'assets/img/intro/video-thumbnail.png',
                        'links' => [
                            [
                                'link_text' => 'Buy Now',
                                'link_url' => '#',
                            ],
                            [
                                'link_text' => 'View Demo',
                                'link_url' => '#',
                            ],
                        ]
                    ]
                ]
            ],
            [
                'type' => 'features',
                'title' => 'Key Features',
                'subtitle' => 'The SaaS platform creation and management features are all available in Ai Writer.',
                'description' => null,
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Ai Generator',
                        'subtitle' => 'With ai writer, you may create text, images, code, chat, and more.',
                        'description' => null,
                        'image' => null,
                        'links' => null,
                    ],
                    [
                        'title' => 'Advance Dashboard',
                        'subtitle' => 'Powerful visualizations and customizable analytics for actionable data insights.',
                        'description' => null,
                        'image' => null,
                        'links' => null,
                    ],
                    [
                        'title' => 'Payment Gateways',
                        'subtitle' => 'Seamless transactions made simple with secure and reliable payment gateways.',
                        'description' => null,
                        'image' => null,
                        'links' => null,
                    ],
                    [
                        'title' => 'Support Platform',
                        'subtitle' => 'Streamlined support platform for efficient assistance.',
                        'description' => null,
                        'image' => null,
                        'links' => null,
                    ],
                    [
                        'title' => 'Speech To Text',
                        'subtitle' => 'Convert speech to text effortlessly for efficient communication.',
                        'description' => null,
                        'image' => null,
                        'links' => null,
                    ],
                    [
                        'title' => 'Text To Speech',
                        'subtitle' => 'Transform text into natural-sounding speech for enhanced communication.',
                        'description' => null,
                        'image' => null,
                        'links' => null,
                    ],
                ]
            ],
            [
                'type' => 'ai_template',
                'title' => 'AI TEMPLATE CONTENT',
                'subtitle' => 'Writing assistant with intelligence',
                'description' => 'The AI Template Content feature is a game-changing tool that harnesses the power of artificial intelligence to simplify and streamline the process of creating compelling written content. With just a few clicks, users can access a wide range of customizable templates equipped with intelligent algorithms that generate high-quality copy to meet their specific needs.',
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Powered by OpenAi',
                        'subtitle' => 'Generate, Edit, Save, Export',
                        'description' => null,
                        'image' => 'assets/img/intro/ai-template.png',
                        'links' => null
                    ]
                ]
            ],
            [
                'type' => 'ai_image',
                'title' => 'AI IMAGE GENERATOR',
                'subtitle' => 'Make captivating visuals and pictures',
                'description' => 'The AI Image Generator is a cutting-edge tool powered by artificial intelligence that allows you to create stunning, high-quality images with just a few clicks. By leveraging advanced algorithms and vast datasets, this tool generates realistic and visually captivating images tailored to your specifications. With the AI Image Generator, you no longer need extensive design skills or hours spent manipulating software.',
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Powered by OpenAi',
                        'subtitle' => 'Generate, Save, Download',
                        'description' => null,
                        'image' => 'assets/img/intro/ai-image.png',
                        'links' => null
                    ]
                ]
            ],
            [
                'type' => 'ai_code',
                'title' => 'AI CODE GENERATOR',
                'subtitle' => 'Create high-quality code quickly.',
                'description' => 'The AI Code Generator is a revolutionary tool that utilizes artificial intelligence to automate and streamline the process of code creation. By analysing patterns, syntax, and best practices from vast code repositories, it generates high-quality code snippets tailored to specific programming languages, frameworks, and functionalities. This powerful tool empowers developers to save time, increase productivity, and focus on higher-level problem-solving.',
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Powered by OpenAi',
                        'subtitle' => 'Generate, Edit, Save',
                        'description' => null,
                        'image' => 'assets/img/intro/ai-code.png',
                        'links' => null
                    ]
                ]
            ],
            [
                'type' => 'ai_chatbot',
                'title' => 'AI CHATBOTS',
                'subtitle' => 'Introducing your new virtual assistant',
                'description' => 'AI chatbots are intelligent virtual assistants designed to interact with users in a natural and conversational manner. Powered by artificial intelligence and natural language processing algorithms, these chatbots can understand and respond to user queries, providing instant assistance and support across a wide range of applications. These chatbots are trained on vast amounts of data and continually learn and improve over time.',
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Powered by OpenAi',
                        'subtitle' => 'Chat, Solve, Repeat',
                        'description' => null,
                        'image' => 'assets/img/intro/ai-chatbot.png',
                        'links' => null
                    ]
                ]
            ],
            [
                'type' => 'speech_to_text',
                'title' => 'AI SPEECH TO TEXT',
                'subtitle' => 'Make a text version of your speech',
                'description' => 'AI Speech-to-Text technology utilizes advanced artificial intelligence algorithms to convert spoken language into written text. By leveraging machine learning and natural language processing techniques, this innovative technology enables accurate and real-time transcription of audio content. With AI Speech-to-Text, users can easily convert recorded or live speech, such as interviews, meetings, lectures, or voice notes, into text format.',
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Powered by OpenAi',
                        'subtitle' => 'Paste Text, Generate',
                        'description' => null,
                        'image' => 'assets/img/intro/speech-to-text.png',
                        'links' => null
                    ]
                ]
            ],
            [
                'type' => 'text_to_speech',
                'title' => 'AI TEXT TO SPEECH',
                'subtitle' => 'Make a speech version of your text',
                'description' => 'AI Text-to-Speech technology utilizes sophisticated artificial intelligence algorithms to convert written text into natural-sounding speech. By leveraging deep learning and neural networks, this innovative technology can generate lifelike and expressive audio representations of written content. With AI Text-to-Speech, users can transform written documents, articles, emails, or any other text-based content into spoken words.',
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Powered by AWS Poly',
                        'subtitle' => 'Upload, Generate',
                        'description' => null,
                        'image' => 'assets/img/intro/text-to-speech.png',
                        'links' => null
                    ]
                ]
            ],
            [
                'type' => 'demo_content',
                'title' => 'Dominate the Content Game with Our Game-Changing AI Platform',
                'subtitle' => 'The AI-powered platform that will take your content to the next level. Innovative AI solutions for content creators and marketers',
                'description' => null,
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Blog Content',
                        'subtitle' => 'Save Time and Write Smarter Your Social Media Post Faster',
                        'description' => 'Simplify your content creation process with AI-powered blog title generator. Transform Your Blogging Success with AI Blog Intros that Set the Tone, Build Trust.',
                        'image' => 'assets/img/intro/blog-dark.png',
                        'links' => [
                            [
                                'link_text' => 'Try For Free',
                                'link_url' => '#',
                            ]
                        ]
                    ],
                    [
                        'title' => 'Social Media',
                        'subtitle' => 'Save Time and Write Smarter Your Social Media Post Faster',
                        'description' => 'Maximize Your Facebook Presence with Captivating Captions Using Our Template. Unlock Your Creativity and Create Compelling Social Media Posts.',
                        'image' => 'assets/img/intro/social-dark.png',
                        'links' => [
                            [
                                'link_text' => 'Try For Free',
                                'link_url' => '#',
                            ]
                        ]
                    ],
                    [
                        'title' => 'Ads Content',
                        'subtitle' => 'Save Time and Effort Write Ads with FastAI Today!',
                        'description' => 'Stand Out on Google and Drive Conversions with Engaging Ads Titles Using Our Template. Simplify your content creation process with AI-powered blog title generator.',
                        'image' => 'assets/img/intro/ads-dark.png',
                        'links' => [
                            [
                                'link_text' => 'Try For Free',
                                'link_url' => '#',
                            ]
                        ]
                    ],
                ]
            ],
            [
                'type' => 'templates',
                'title' => 'Explore Our Amazing Templates',
                'subtitle' => 'Stand Out on Google and Drive Conversions with Engaging Ads Titles Using Our Template.',
                'description' => null,
                'asset' => null,
                'children' => null
            ],
            [
                'type' => 'testimonials',
                'title' => 'What our Users say About us',
                'subtitle' => 'More than 15K+ customer says about us!',
                'description' => null,
                'asset' => null,
                'children' => null
            ],
            [
                'type' => 'faqs_content',
                'title' => 'Feel free to ask any Questions!',
                'subtitle' => 'A Comprehensive Guide to Frequently Asked Questions',
                'description' => null,
                'asset' => 'assets/img/intro/faqs-right.png',
                'children' => [
                    [
                        'title' => 'How accurate are the outputs of an AI writer?',
                        'subtitle' => null,
                        'description' => 'While AI writers are capable of generating content, including text, headlines, and summaries, it is still a matter of debate whether they can generate truly creative content that rivals that of human writers.',
                        'image' => null,
                        'links' => null
                    ],
                    [
                        'title' => 'Are AI writers capable of generating creative content?',
                        'subtitle' => null,
                        'description' => 'While AI writers are capable of generating content, including text, headlines, and summaries, it is still a matter of debate whether they can generate truly creative content that rivals that of human writers.',
                        'image' => null,
                        'links' => null
                    ],
                    [
                        'title' => 'Can AI writers write in different languages?',
                        'subtitle' => null,
                        'description' => 'While AI writers are capable of generating content, including text, headlines, and summaries, it is still a matter of debate whether they can generate truly creative content that rivals that of human writers.',
                        'image' => null,
                        'links' => null
                    ],
                    [
                        'title' => 'Can AI writers replace human writers?',
                        'subtitle' => null,
                        'description' => 'While AI writers are capable of generating content, including text, headlines, and summaries, it is still a matter of debate whether they can generate truly creative content that rivals that of human writers.',
                        'image' => null,
                        'links' => null
                    ],
                    [
                        'title' => 'Can AI writers write in different languages?',
                        'subtitle' => null,
                        'description' => 'While AI writers are capable of generating content, including text, headlines, and summaries, it is still a matter of debate whether they can generate truly creative content that rivals that of human writers.',
                        'image' => null,
                        'links' => null
                    ],
                ]
            ],
            [
                'type' => 'pricing',
                'title' => 'The Perfect Price Plan for you',
                'subtitle' => 'Find the Perfect Plan for Your Business Goals with Our Comprehensive Pricing Options',
                'description' => null,
                'asset' => null,
                'children' => null
            ],
            [
                'type' => 'partners',
                'title' => 'Our Trusted Partners',
                'subtitle' => 'Empowering Your Business with Our Trusted Partners',
                'description' => null,
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Our Trusted Partners',
                        'subtitle' => null,
                        'description' => null,
                        'image' => 'assets/logo/stripe-dark.png',
                        'links' => null
                    ],
                    [
                        'title' => 'Our Trusted Partners',
                        'subtitle' => null,
                        'description' => null,
                        'image' => 'assets/logo/paddle-dark.png',
                        'links' => null
                    ],
                    [
                        'title' => 'Our Trusted Partners',
                        'subtitle' => null,
                        'description' => null,
                        'image' => 'assets/logo/razorpay-dark.png',
                        'links' => null
                    ],
                    [
                        'title' => 'Our Trusted Partners',
                        'subtitle' => null,
                        'description' => null,
                        'image' => 'assets/logo/openai-dark.png',
                        'links' => null
                    ],
                    [
                        'title' => 'Our Trusted Partners',
                        'subtitle' => null,
                        'description' => null,
                        'image' => 'assets/logo/laravel-dark.png',
                        'links' => null
                    ],
                ]
            ],
            [
                'type' => 'banner',
                'title' => 'Have any questions about our template?',
                'subtitle' => null,
                'description' => null,
                'asset' => null,
                'children' => [
                    [
                        'title' => 'Have any questions about our template?',
                        'subtitle' => null,
                        'description' => null,
                        'image' => null,
                        'links' => [
                            [
                                'link_text' => 'Buy Now',
                                'link_url' => '#',
                            ],
                            [
                                'link_text' => 'View Demo',
                                'link_url' => '#',
                            ],
                        ]
                    ]
                ]
            ],
        ];


        foreach ($intro_sections as $intro_section) {
            $section = IntroSection::create([
                'type' => $intro_section['type'],
                'title' => $intro_section['title'],
                'subtitle' => $intro_section['subtitle'],
                'description' => $intro_section['description'],
                'asset' => $intro_section['asset'],
            ]);

            if ($intro_section['children']) {
                foreach ($intro_section['children'] as $children) {
                    $child = ChildSection::create([
                        'title' => $children['title'],
                        'subtitle' => $children['subtitle'],
                        'description' => $children['description'],
                        'image' => $children['image'],
                        'intro_section_id' => $section->id,
                    ]);

                    if ($children['links']) {
                        foreach ($children['links'] as $children_link) {
                            ChildSectionLink::create([
                                'link_text' => $children_link['link_text'],
                                'link_url' => $children_link['link_url'],
                                'child_section_id' => $child->id,
                            ]);
                        }
                    }
                }
            }
        }
    }
}
