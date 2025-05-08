import React, { useEffect, useState } from "react";
import { useLocation, useNavigate } from "react-router-dom";

const Foreign = () => {
  const [article, setArticle] = useState(null);
  const location = useLocation();
  const navigate = useNavigate();

  const query = new URLSearchParams(location.search);
  const id = query.get("id");

  useEffect(() => {
    if (id) {
      fetch(`http://localhost/NepNews/ReactBackend/get_article.php?id=${id}`)
        .then((res) => res.json())
        .then((data) => {
          if (data.error) {
            console.error(data.error);
          } else {
            setArticle(data);
          }
        })
        .catch((err) => console.error("Failed to fetch article:", err));
    }
  }, [id]);

  if (!article) {
    return <div className="text-center mt-32 text-xl">Loading article...</div>;
  }

  return (
    <section className="bg-white px-8 min-h-screen">
      <div className="mt-20 ml-10 mr-10">
        {/* Back to Home Link */}
        <a href="/" className="text-blue-600 hover:underline text-sm md:text-base mb-6 inline-block">
          &larr; Back to Home
        </a>

        {/* Article Heading */}
        <h1 className="text-3xl font-bold text-red-600 mt-2">{article.title}</h1>

        {/* Author and Meta */}
        <div className="flex items-center mt-4">
          <div className="w-10 h-10 bg-gray-300 rounded-full"></div>
          <div className="ml-4">
            <p className="text-sm font-semibold text-black">
              {article.admin || "Staff Writer"}
            </p>
            <p className="text-sm text-gray-500">{article.category}</p>
            <div className="flex items-center text-gray-500 text-sm mt-2">
              <span className="mr-2">&#x1F553;</span>
              <span>
                {article.date !== "0000-00-00"
                  ? new Date(article.date).toLocaleDateString()
                  : "Date not specified"}
              </span>
            </div>
          </div>
        </div>
      </div>

      {/* Image */}
      <div className="flex justify-center mt-16">
        <img
          src={`http://localhost/NepNews/images/${article.thumbnail || 'default-news.jpg'}`}
          alt="Article"
          className="w-[60%] h-auto rounded-lg shadow"
          onError={(e) => {
            e.target.src = 'http://localhost/NepNews/images/default-news.jpg';
          }}
        />
      </div>

      {/* Description */}
      <div className="mt-9 font-['cursive'] text-xl ml-20 mr-20 leading-8">
        <p>{article.description || "No description available."}</p>
      </div>
    </section>
  );
};

export default Foreign;
