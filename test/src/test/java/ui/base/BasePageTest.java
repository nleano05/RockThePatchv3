package ui.base;


import org.openqa.selenium.*;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;
import org.openqa.selenium.support.ui.WebDriverWait;
import ui.utils.Constants;
import java.awt.*;
import java.awt.datatransfer.Clipboard;
import java.awt.datatransfer.StringSelection;
import static org.junit.Assert.*;


public class BasePageTest {

    private static final String TAG = BasePageTest.class.getSimpleName();

    public static void testTitle(WebDriver driver, String url, String expectedTitle) {
        driver.get(url);
        driver.manage().window().maximize();
        assertEquals("Title matches expected title", expectedTitle, driver.getTitle());
    }

    public static void testHTML5Validation(WebDriver driver, String url) {
        driver.get(url);
        driver.manage().window().maximize();
        WebDriverWait wait = new WebDriverWait(driver, Constants.WAIT_TIME);

        String pageSource = driver.getPageSource();
        StringSelection stringSelection = new StringSelection(pageSource);
        Clipboard clipboard = Toolkit.getDefaultToolkit().getSystemClipboard();
        clipboard.setContents(stringSelection, null);

        driver.get("http://validator.w3.org/#validate_by_input+with_options");

        ExpectedConditions.visibilityOf(driver.findElement(By.xpath("//*[@id=\"direct-doctype\"]")));
        Select select = new Select(driver.findElement(By.xpath("//*[@id=\"direct-doctype\"]")));
        select.selectByVisibleText("HTML5 (experimental)");

        ExpectedConditions.presenceOfElementLocated(By.xpath("//*[@id=\"fragment\"]"));
        WebElement element =  driver.findElement(By.xpath("//*[@id=\"fragment\"]"));

        //noinspection StringConcatenationMissingWhitespace
        element.sendKeys(Keys.CONTROL + "v");

        ExpectedConditions.presenceOfElementLocated(By.xpath("//*[@id=\"validate-by-input\"]/form/p[2]/a/span"));
        driver.findElement(By.xpath("//*[@id=\"validate-by-input\"]/form/p[2]/a/span")).click();

        ExpectedConditions.presenceOfElementLocated(By.cssSelector("html body div#results p.success"));
        ExpectedConditions.visibilityOfElementLocated(By.cssSelector("html body div#results p.success"));
    }

    public static void testXHTMLValidation(WebDriver driver, String url) {
        driver.get(url);
        driver.manage().window().maximize();
        WebDriverWait wait = new WebDriverWait(driver, Constants.WAIT_TIME);

        String pageSource = driver.getPageSource();
        StringSelection stringSelection = new StringSelection(pageSource);
        Clipboard clipboard = Toolkit.getDefaultToolkit().getSystemClipboard();
        clipboard.setContents(stringSelection, null);

        driver.get("http://validator.w3.org/#validate_by_input+with_options");

        ExpectedConditions.visibilityOf(driver.findElement(By.xpath("//*[@id=\"direct-doctype\"]")));
        Select select = new Select(driver.findElement(By.xpath("//*[@id=\"direct-doctype\"]")));
        select.selectByVisibleText("XHTML 1.1");

        ExpectedConditions.presenceOfElementLocated(By.xpath("//*[@id=\"fragment\"]"));
        WebElement element =  driver.findElement(By.xpath("//*[@id=\"fragment\"]"));

        //noinspection StringConcatenationMissingWhitespace
        element.sendKeys(Keys.CONTROL + "v");

        ExpectedConditions.presenceOfElementLocated(By.xpath("//*[@id=\"validate-by-input\"]/form/p[2]/a/span"));
        driver.findElement(By.xpath("//*[@id=\"validate-by-input\"]/form/p[2]/a/span")).click();

        wait.until(ExpectedConditions.titleContains("[Valid] Markup Validation"));
        assertTrue("Valid markup found", driver.getTitle().startsWith("[Valid] Markup Validation"));
    }

    @SuppressWarnings({"unused", "Annotation"})
    public interface Callbacks {
        void testTitle();
        void testXHTMLValidation();
        void testHTML5Validation();
    }
}