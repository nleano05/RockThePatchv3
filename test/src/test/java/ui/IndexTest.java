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

@Browser
public class IndexTest extends BasePageTest implements BasePageTest.Callbacks {

    private static final String TAG = IndexTest.class.getSimpleName();

    private static WebDriver sDriver;

    private static final String PAGE_URL = UrlUtil.URL_MAIN_PAGE;

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
        BasePageTest.testTitle(sDriver, PAGE_URL, Constants.TITLE_MAIN_PAGE);
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

    @Test
    public void testRSSValidation() {
        sDriver.get(PAGE_URL);
        sDriver.manage().window().maximize();

        ExpectedConditions.presenceOfElementLocated(By.xpath("/html/body/div/div[4]/div[4]/p/a[3]/img"));
        ExpectedConditions.visibilityOf(sDriver.findElement(By.xpath("/html/body/div/div[4]/div[4]/p/a[3]/img")));
        sDriver.findElement(By.xpath("/html/body/div/div[4]/div[4]/p/a[3]/img")).click();

        ExpectedConditions.presenceOfElementLocated(By.xpath("/html/body/div[2]/blockquote[1]/p"));
        ExpectedConditions.visibilityOf(sDriver.findElement(By.xpath("/html/body/div[2]/blockquote[1]/p")));
        assertEquals("Valid RSS feed", "This is a valid RSS feed.", sDriver.findElement(By.xpath("/html/body/div[2]/blockquote[1]/p")).getText());
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
