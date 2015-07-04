package ui.base;


import com.google.common.base.Predicate;
import org.openqa.selenium.*;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.Select;
import org.openqa.selenium.support.ui.WebDriverWait;
import java.awt.*;
import java.awt.datatransfer.Clipboard;
import java.awt.datatransfer.StringSelection;
import static org.junit.Assert.*;


public class BasePageTest {

    private static final String TAG = BasePageTest.class.getSimpleName();

    public void testTitle(WebDriver driver, String url, String expectedTitle) {
        driver.get(url);
        driver.manage().window().maximize();
        assertTrue(driver.getTitle().equals(expectedTitle));
    }

    public void testHTML5Validation(WebDriver driver, String url) {
        driver.get(url);
        driver.manage().window().maximize();
        WebDriverWait wait = new WebDriverWait(driver, 30);

        //noinspection Convert2Lambda
        wait.until( new Predicate<WebDriver>() {
            public boolean apply(WebDriver driver) {
                return ((JavascriptExecutor)driver).executeScript("return document.readyState").equals("complete");
            }
        });

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

        element.sendKeys(Keys.CONTROL + "v");

        ExpectedConditions.presenceOfElementLocated(By.xpath("//*[@id=\"validate-by-input\"]/form/p[2]/a/span"));
        driver.findElement(By.xpath("//*[@id=\"validate-by-input\"]/form/p[2]/a/span")).click();

        wait.until(ExpectedConditions.titleContains("[Valid] Markup Validation"));
        assertTrue(driver.getTitle().startsWith("[Valid] Markup Validation"));
    }

    public void testXHTMLValidation(WebDriver driver, String url) {
        driver.get(url);
        driver.manage().window().maximize();
        WebDriverWait wait = new WebDriverWait(driver, 30);

        wait.until( new Predicate<WebDriver>() {
            public boolean apply(WebDriver driver) {
                return ((JavascriptExecutor)driver).executeScript("return document.readyState").equals("complete");
            }
        });

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

        element.sendKeys(Keys.CONTROL + "v");

        ExpectedConditions.presenceOfElementLocated(By.xpath("//*[@id=\"validate-by-input\"]/form/p[2]/a/span"));
        driver.findElement(By.xpath("//*[@id=\"validate-by-input\"]/form/p[2]/a/span")).click();

        wait.until(ExpectedConditions.titleContains("[Valid] Markup Validation"));
        assertTrue(driver.getTitle().startsWith("[Valid] Markup Validation"));
    }

    @SuppressWarnings("unused")
    public interface Callbacks {
        void testTitle();
        void testXHTMLValidation();
        void testHTML5Validation();
    }
}