package ui;


import org.junit.AfterClass;
import org.junit.BeforeClass;
import org.junit.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import ui.annotations.Browser;
import ui.base.BasePageTest;
import ui.utils.Constants;
import ui.utils.DriverUtil;
import ui.utils.UrlUtil;
import static org.junit.Assert.*;

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

    @Test
    public void testRSSValidation() {
        gDriver.get(UrlUtil.URL_MAIN_PAGE);
        gDriver.manage().window().maximize();

        ExpectedConditions.presenceOfElementLocated(By.xpath("/html/body/div/div[4]/div[4]/p/a[3]/img"));
        ExpectedConditions.visibilityOf(gDriver.findElement(By.xpath("/html/body/div/div[4]/div[4]/p/a[3]/img")));
        gDriver.findElement(By.xpath("/html/body/div/div[4]/div[4]/p/a[3]/img")).click();

        ExpectedConditions.presenceOfElementLocated(By.xpath("/html/body/div[2]/blockquote[1]/p"));
        ExpectedConditions.visibilityOf(gDriver.findElement(By.xpath("/html/body/div[2]/blockquote[1]/p")));
        assertEquals("Valid RSS feed", "This is a valid RSS feed.", gDriver.findElement(By.xpath("/html/body/div[2]/blockquote[1]/p")).getText());
    }

//    @Test
//    public void testCSSValidation() {
//        gDriver.get("http://jigsaw.w3.org/css-validator/validator?uri=" + UrlUtil.SHORT_DEV_URL + "/&profile=css3");
//        gDriver.manage().window().maximize();
//
//        ExpectedConditions.presenceOfElementLocated(By.xpath("/html/body/div[2]/div[1]/p[1]"));
//        ExpectedConditions.visibilityOf(gDriver.findElement(By.xpath("/html/body/div[2]/div[1]/p[1]")));
//        assertEquals(gDriver.findElement(By.xpath("/html/body/div[2]/div[1]/p[1]")).getText(), "This document validates as CSS level 3 !");
//    }
}
