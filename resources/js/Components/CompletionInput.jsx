import React from "react";
import ArticleGenerate from "./TemplateInputs/ArticleGenerate";
import BlogTitles from "./TemplateInputs/BlogTitles";
import BlogSection from "./TemplateInputs/BlogSection";
import BlogIdeas from "./TemplateInputs/BlogIdeas";
import BlogIntros from "./TemplateInputs/BlogIntros";
import BlogConclusion from "./TemplateInputs/BlogConclusions";
import SummarizeText from "./TemplateInputs/SummarizeText";
import StartupNameIdeas from "./TemplateInputs/StartupNameIdeas";
import TestimonialReviews from "./TemplateInputs/TestimonialReviews";
import YouTubeTagIdea from "./TemplateInputs/YouTubeTagIdea";
import VideoTitles from "./TemplateInputs/VideoTitles";
import VideoDescription from "./TemplateInputs/VideoDescription";
import InstagramCaptions from "./TemplateInputs/InstagramCaptions";
import InstagramHashtagsIdeas from "./TemplateInputs/InstagramHashtagsIdeas";
import SocialMediaPostPersonal from "./TemplateInputs/SocialMediaPostPersonal";
import SocialMediaPostBusiness from "./TemplateInputs/SocialMediaPostBusiness";
import FacebookCaptions from "./TemplateInputs/FacebookCaptions";
import FacebookAds from "./TemplateInputs/FacebookAds";
import GoogleAdsTitles from "./TemplateInputs/GoogleAdsTitles";
import GoogleAdsDetails from "./TemplateInputs/GoogleAdsDetails";
import ContentRewriter from "./TemplateInputs/ContentRewriter";
import ParagraphGenerator from "./TemplateInputs/ParagraphGenerator";
import TalkingPoints from "./TemplateInputs/TalkingPoints";
import ProsAndCons from "./TemplateInputs/ProsAndCons";
import ProductNameIdeas from "./TemplateInputs/ProductNameIdeas";
import ProductDescription from "./TemplateInputs/ProductDescription";
import MetaDescription from "./TemplateInputs/MetaDescription";
import FAQs from "./TemplateInputs/FAQs";
import FAQAnswers from "./TemplateInputs/FAQAnswers";
import ProblemAgitateSolution from "./TemplateInputs/ProblemAgitateSolution";

const CompletionInput = ({ data, errors, template, onHandleChange }) => {
    return (
        <>
            {template && template === "blog-titles" ? (
                <BlogTitles
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "blog-section" ? (
                <BlogSection
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "blog-ideas" ? (
                <BlogIdeas
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "blog-intros" ? (
                <BlogIntros
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "blog-conclusion" ? (
                <BlogConclusion
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "summarize-text" ? (
                <SummarizeText
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "startup-name-idea" ? (
                <StartupNameIdeas
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "testimonial-reviews" ? (
                <TestimonialReviews
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "youtube-tag-idea" ? (
                <YouTubeTagIdea
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "video-titles" ? (
                <VideoTitles
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "video-description" ? (
                <VideoDescription
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "instagram-captions" ? (
                <InstagramCaptions
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "instagram-hashtag-idea" ? (
                <InstagramHashtagsIdeas
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "social-media-post-personal" ? (
                <SocialMediaPostPersonal
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "social-media-post-business" ? (
                <SocialMediaPostBusiness
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "facebook-captions" ? (
                <FacebookCaptions
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "facebook-ads" ? (
                <FacebookAds
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "google-ads-titles" ? (
                <GoogleAdsTitles
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "google-ads-details" ? (
                <GoogleAdsDetails
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "article-generator" ? (
                <ArticleGenerate
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "content-re-writer" ? (
                <ContentRewriter
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "paragraph-generator" ? (
                <ParagraphGenerator
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "talking-points" ? (
                <TalkingPoints
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "pros-cons" ? (
                <ProsAndCons
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "product-name-idea" ? (
                <ProductNameIdeas
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "product-description" ? (
                <ProductDescription
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "meta-description" ? (
                <MetaDescription
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "faqs" ? (
                <FAQs
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "faq-answers" ? (
                <FAQAnswers
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : template === "problem-agitate-solution" ? (
                <ProblemAgitateSolution
                    data={data}
                    errors={errors}
                    onHandleChange={onHandleChange}
                />
            ) : (
                ""
            )}
        </>
    );
};

export default CompletionInput;
