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

@SuppressWarnings("Annotation")
@Browser(browser = Constants.CHROME)
public class IndexPageTest extends BasePageTest implements BasePageTest.Callbacks {

    private static final String TAG = IndexPageTest.class.getSimpleName();

    private static WebDriver gDriver;

    @BeforeClass
    public static void setup() {
        Browser browser = IndexPageTest.class.getAnnotation(Browser.class);
        String browserName = browser.browser();
        gDriver = DriverUtil.getWebDriver(browserName);
        gDriver.get(UrlUtil.URL_MAIN_PAGE);
        gDriver.manage().window().maximize();
    }

    @AfterClass
    public static void teardown(){
        gDriver.quit();
    }

    @Test
    @Override
    public void testTitle() {
        BasePageTest.testTitle(gDriver, UrlUtil.URL_MAIN_PAGE, Constants.TITLE_MAIN_PAGE);
    }

    @Test
    @Override
    public void testXHTMLValidation() {
        BasePageTest.testXHTMLValidation(gDriver, UrlUtil.URL_MAIN_PAGE);
    }

    @Test
    @Override
    public void testHTML5Validation() {
        BasePageTest.testHTML5Validation(gDriver, UrlUtil.URL_MAIN_PAGE);
    }
}
