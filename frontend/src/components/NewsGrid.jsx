const NewsGrid = ({ news }) => {
  return (
    <div className="grid gap-4 lg:grid-cols-4 mt-4">
      {news.length > 0 ? (
        news.map((items) => (
          <div
            className="w-full rounded-lg shadow-lg overflow-hidden lg:max-w-sm"
            key={crypto.randomUUID()}
          >
            <img
              className="object-cover w-full h-48"
              src={
                items.urlToImage ??
                "https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
              }
              alt="image"
            />
            <div className="p-4">
              <h4 className="text-2xl font-semibold text-blue-600">
                {items.title}
              </h4>
              <p className="mb-4 text-lg leading-relaxed">{items.content}</p>
              <div className="justify-between flex flex-row">
                <div className="font-semibold text-gray-700">by {items.author}</div>
                <div className="text-gray-500">{items.publishedAt}</div>
              </div>
              <div>
                <button className="px-4 py-2 mt-4 text-sm text-blue-100 bg-blue-500 rounded shadow">
                  <a href={items.url}>Read more</a>
                </button>
              </div>
            </div>
          </div>
        ))
      ) : (
        <div>No news available</div>
      )}
    </div>
  );
};

export default NewsGrid;
