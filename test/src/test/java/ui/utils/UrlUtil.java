package ui.utils;

import ui.models.Environment;

public class UrlUtil {

    private static final String TAG = UrlUtil.class.getSimpleName();

    public static final String BASE_DEV_URL = "http://127.0.0.1/";
    public static final String BASE_INTEGRATION_URL = "https://integration.rockthepatch.com/";
    public static final String BASE_STAGING_URL = "https://staging.rockthepatch.com/";
    public static final String BASE_PRODUCTION_URL = "https://rockthepatch.com/";

    public static final String URL_MAIN_PAGE = getBaseUrl() + "index.php";

    public static String getBaseUrl() {
        String baseUrl;
        Environment environment = Environment.DEV;

        switch (environment) {
            case DEV:
                baseUrl = BASE_DEV_URL;
                break;
            case INTEGRATION:
                baseUrl = BASE_INTEGRATION_URL;
                break;
            case STAGING:
                baseUrl = BASE_STAGING_URL;
                break;
            case PRODUCTION:
                baseUrl = BASE_PRODUCTION_URL;
                break;
            default:
                LogUtil.error(TAG, "Unhandled environment");
                baseUrl = "";
                break;
        }

        return baseUrl;
    }
}
