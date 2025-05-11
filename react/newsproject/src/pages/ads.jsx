import React, { useState, useEffect } from 'react';

const Ads = () => {
  const [ads, setAds] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchAds = async () => {
      try {
        const res = await fetch('http://localhost/NepNews/ReactBackend/get_active_ads.php', {
          headers: {
            'Accept': 'application/json',
          }
        });

        if (!res.ok) throw new Error(`HTTP error! Status: ${res.status}`);
        
        const data = await res.json();
        setAds(data);
      } catch (err) {
        setError(err.message);
        console.error("Fetch error:", err);
      } finally {
        setLoading(false);
      }
    };

    fetchAds();
  }, []);

  return (
    <div>
      {loading && <p>Loading ads...</p>}
      {error && <p>Error: {error}</p>}
      {ads.map(ad => (
        <a key={ad.id} href={ad.redirect_link} target="_blank" rel="noopener">
          <img 
            src={`http://localhost/NepNews/images/${ad.ad_image}`} 
            alt="Advertisement"
          />
        </a>
      ))}
    </div>
  );
};
export default Ads;