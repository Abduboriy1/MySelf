<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiChatController extends Controller
{
    private const PORTFOLIO_CONTEXT = <<<TEXT
        Abduboriy Abdurakhmonov - Software Engineer in Location: O'Fallon, MO. Contact: uzbekbory@gmail.com, (636) 575-1811. GitHub: github.com/abduboriy1. LinkedIn: linkedin.com/in/abduboriy.
        Education: Truman State University, Bachelor of Science in Computer Science, Spring 2023.
        Experience: Prologue Technology (Aug 2023 - Present) - Led multiple projects, developed and maintained applications using PHP, MySQL, Laravel, Yii Framework.
        Experience: K&F Express LLC (Aug 2019 - Aug 2023) - Led a 5-person team to develop a web app using Amazon API, React, CSS, HTML, PHP, JavaScript, TypeScript, Firebase.
        Experience: Truman State University (Aug 2020 - May 2022) - Web Developer for Diversity and Inclusion site. Updated components, improved SEO, used HTML, JS, CSS, Bootstrap.
        Languages & Tools: C++, C, Java, Python, JavaScript, Clojure, C#, Assembly (MIPS), HTML, .NET, CSS, React JS, React Native, SQL, MySQL, Google Cloud API, PHP, Yii Framework, Laravel, Vue.
        Workflow & Tools: Agile, Waterfall, Git Version Control, Visual Studio Code, IntelliJ, Eclipse, Jenkins, Microsoft Visual Studio, Jira, BitBucket.
        Projects: xLogs (2022-2023) - Fleet management application for trucking companies. Initially built with React and Firebase, later optimized using Laravel and Vue.js.
        Projects: React App (2020) - JavaScript extension to help truck drivers find and accept tasks, saving 7+ hours. Used Google Chrome API, JavaScript, Bootstrap. $14,000 MRR.
        Projects: Main Street Kirksville (2021) - Advertising website for local businesses, built with React, CSS, HTML, PHP.
        Specializations: Artificial Intelligence, Systems Programming, Data Structures & Algorithms, Cybersecurity, Computer Networks, Databases, Compilers, Computer Graphics.
        Activities: Association of Computing Machinery, Pi Kappa Phi Fraternity (ΠΚΦ), Water Polo Club.
        Experience: 6 Years.
    TEXT;

    private const AGENT_PERSONA = <<<TEXT
        Make the responses short and concise as much as possible.
        You are a professional sales representative whose sole job is to sell Bory Abdurakhmonov as the best possible choice for clients.
        When someone visits his website and asks questions about him, respond with enthusiasm, confidence, and persuasion.
        Your goal is to impress them, highlight his skills, experience, and achievements, and convince them that he is the right person to help them.
        Use engaging language, highlight unique strengths, and provide compelling reasons why they should work with him.
        If they have objections or hesitations, counter them with well-reasoned responses that build trust and credibility.

        Additional Guidelines:
        - Keep responses professional yet friendly.
        - Highlight key achievements and relevant experience.
        - Address objections with confidence and reassurance.
        - Use persuasive language and storytelling where appropriate.
        - If unsure about specifics, generalize in a way that maintains a strong, positive impression.

        Context about Bory:
    TEXT;

    public function query(Request $request): JsonResponse
    {
        $request->validate([
            'query' => ['required', 'string', 'max:500'],
        ]);

        $apiKey = config('services.gemini.key');

        if (empty($apiKey)) {
            Log::error('AiChatController: GEMINI_API_KEY is not set.');
            return response()->json(['error' => 'AI service is not configured.'], 503);
        }

        $systemPrompt = self::AGENT_PERSONA . "\n\n" . self::PORTFOLIO_CONTEXT;

        $response = Http::timeout(30)->post(
            "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key={$apiKey}",
            [
                'system_instruction' => [
                    'parts' => [['text' => $systemPrompt]],
                ],
                'contents' => [
                    [
                        'role'  => 'user',
                        'parts' => [['text' => $request->input('query')]],
                    ],
                ],
            ]
        );

        if ($response->failed()) {
            Log::error('AiChatController: Gemini API error', ['status' => $response->status()]);
            return response()->json(['error' => json_decode($response->body())], 502);
        }

        $text = $response->json('candidates.0.content.parts.0.text');

        if (empty($text)) {
            return response()->json(['error' => 'AI returned an empty response.'], 502);
        }

        return response()->json(['response' => $text]);
    }
}
