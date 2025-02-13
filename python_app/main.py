from flask import Flask, request, jsonify
import chromadb
import google.generativeai as genai
from dotenv import load_dotenv
import os


app = Flask(__name__)
load_dotenv()

# Configure API Keys
genai.configure(api_key=os.getenv("GEMINI_API_KEY"))

# Initialize ChromaDB
chroma_client = chromadb.Client()
collection = chroma_client.create_collection(name="my_collection")

agentContext = """
    Make the responses short and consise as much as possible.
    "You are a professional sales representative whose sole job is to sell me (Bory Abdurakhmonov) as the best possible choice for clients. When someone visits my website and asks questions about me, respond with enthusiasm, confidence, and persuasion. Your goal is to impress them, highlight my skills, experience, and achievements, and convince them that I am the right person to help them with their needs. Use engaging language, highlight unique strengths, and provide compelling reasons why they should work with me. If they have objections or hesitations, counter them with well-reasoned responses that build trust and credibility."

    Additional Guidelines:
    
    Keep responses professional yet friendly.
    Highlight key achievements and relevant experience.
    Address objections with confidence and reassurance.
    Use persuasive language and storytelling where appropriate.
    If unsure about specifics, generalize in a way that maintains a strong, positive impression.
"""

collection.add(
    documents = [
            "Abduboriy Abdurakhmonov - Software Engineer in Location: O'Fallon, MO. Contact: uzbekbory@gmail.com, (636) 575-1811. GitHub: github.com/abduboriy1. LinkedIn: linkedin.com/in/abduboriy.",
            "Education: Truman State University, Bachelor of Science in Computer Science, Spring 2023.",
            "Experience: Prologue Technology (Aug 2023 - Present) - Led multiple projects, developed and maintained applications using PHP, MySQL, Laravel, Yii Framework.",
            "Experience: K&F Express LLC (Aug 2019 - Aug 2023) - Led a 5-person team to develop a web app using Amazon API, React, CSS, HTML, PHP, JavaScript, TypeScript, Firebase.",
            "Experience: Truman State University (Aug 2020 - May 2022) - Web Developer for Diversity and Inclusion site. Updated components, improved SEO, used HTML, JS, CSS, Bootstrap.",
            "Languages & Tools: C++, C, Java, Python, JavaScript, Clojure, C#, Assembly (MIPS), HTML, .NET, CSS, React JS, React Native, SQL, MySQL, Google Cloud API, PHP, Yii Framework, Laravel, Vue.",
            "Workflow & Tools: Agile, Waterfall, Git Version Control, Visual Studio Code, IntelliJ, Eclipse, Jenkins, Microsoft Visual Studio, Jira, BitBucket.",
            "Projects: xLogs (2022-2023) - Fleet management application for trucking companies. Initially built with React and Firebase, later optimized using Laravel and Vue.js.",
            "Projects: React App (2020) - JavaScript extension to help truck drivers find and accept tasks, saving 7+ hours. Used Google Chrome API, JavaScript, Bootstrap. $14,000 MRR.",
            "Projects: Main Street Kirksville (2021) - Advertising website for local businesses, built with React, CSS, HTML, PHP.",
            "Specializations: Artificial Intelligence, Systems Programming, Data Structures & Algorithms, Cybersecurity, Computer Networks, Databases, Compilers, Computer Graphics.",
            "Activities: Association of Computing Machinery, Pi Kappa Phi Fraternity (ΠΚΦ), Water Polo Club.",
            "Experience: 6 Years",
        ],

        ids = [
            "resume-001",
            "resume-002",
            "resume-003",
            "resume-004",
            "resume-005",
            "resume-006",
            "resume-007",
            "resume-008",
            "resume-009",
            "resume-010",
            "resume-011",
            "resume-012",
            "resume-013",
        ]
)

def query_gemini(prompt, context):
    model = genai.GenerativeModel("gemini-2.0-flash")
    response = model.generate_content(f"{agentContext} \n\nContext:\n{context}\n\nQuestion: {prompt}")
    return response.text

@app.route('/query', methods=['POST'])
def query():
    data = request.get_json()
    query_text = data.get('query', '')

    if not query_text:
        return jsonify({'error': 'Query is required'}), 400

    context = collection.query(
        query_texts=[query_text],  # Chroma will embed this for you
        n_results=10  # Number of results to return
    )

    response = query_gemini(query_text, context)
    return jsonify({'response': response})

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
