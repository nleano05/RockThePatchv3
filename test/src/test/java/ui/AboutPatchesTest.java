package ui;


import org.junit.AfterClass;
import org.junit.BeforeClass;
import org.junit.Test;
import org.openqa.selenium.WebDriver;
import ui.annotations.Browser;
import ui.base.BasePageTest;
import ui.utils.Constants;
import ui.utils.DriverUtil;
import ui.utils.UrlUtil;

@Browser
public class AboutPatchesTest extends BasePageTest implements BasePageTest.Callbacks {

    private static final String TAG = IndexTest.class.getSimpleName();

    private static WebDriver sDriver;

    private static final String PAGE_URL = UrlUtil.URL_ABOUT_PATCHES;

    @BeforeClass
    public static void setup() {
        Browser browser = IndexTest.class.getAnnotation(Browser.class);
        String browserName = browser.browser();
        sDriver = DriverUtil.getWebDriver(browserName);
        sDriver.get(UrlUtil.URL_MAIN_PAGE);
        sDriver.manage().window().maximize();
    }

    @AfterClass
    public static void teardown(){
        sDriver.quit();
    }

    @Test
    @Override
    public void testTitle() {
        BasePageTest.testTitle(sDriver, PAGE_URL, Constants.TITLE_ABOUT_PATCHES);
    }

    @Test
    @Override
    public void testXHTMLValidation() {
        BasePageTest.testXHTMLValidation(sDriver, PAGE_URL);
    }

    @Test
    @Override
    public void testHTML5Validation() {
        BasePageTest.testHTML5Validation(sDriver, PAGE_URL);
    }
}