SELECT ads.*, COUNT(ad_id) AS ads_count
FROM ads
LEFT JOIN ad_views ON ads.id = ad_views.ad_id
GROUP BY ads.id
ORDER BY ads_count
LIMIT 3
