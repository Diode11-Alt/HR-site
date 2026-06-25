
import { Helmet } from 'react-helmet-async';
import { useLocation } from 'react-router-dom';

/**
 * Reusable, programmatic wrapper component for SEO metadata
 * Interacts directly with the DOM header layout via React Helmet
 */
export default function SEOHead({ title, description, keywords, type = 'website' }) {
  const location = useLocation();
  const currentUrl = `https://primepathuae.com${location.pathname}`;

  return (
    <Helmet>
      {/* Explicit Browser Tab Title */}
      <title>{title}</title>
      
      {/* Specific Descriptive Metadata Snippets */}
      <meta name="description" content={description} />
      {keywords && <meta name="keywords" content={keywords} />}
      
      {/* Clean Canonical Asset Links */}
      <link rel="canonical" href={currentUrl} />
      
      {/* Structural Open-Graph Attributes */}
      <meta property="og:url" content={currentUrl} />
      <meta property="og:type" content={type} />
      <meta property="og:title" content={title} />
      <meta property="og:description" content={description} />
      
      {/* Additional Standard Viewport & Robots Config (though usually in index.html, good for completeness) */}
      <meta name="robots" content="index, follow" />
    </Helmet>
  );
}
