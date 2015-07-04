package ui.utils;


import org.openqa.selenium.WebDriver;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.firefox.FirefoxDriver;
import org.openqa.selenium.ie.InternetExplorerDriver;
import org.openqa.selenium.opera.OperaDriver;
import org.openqa.selenium.remote.DesiredCapabilities;
import org.openqa.selenium.safari.SafariDriver;
import java.util.concurrent.TimeUnit;


public class DriverUtil {

    private static final String TAG = DriverUtil.class.getSimpleName();

    /**
     * @param browser - the string name of the browser to get a driver for
     */
    public static WebDriver getWebDriver(String browser){
        WebDriver driver = null;
        switch (browser) {
            case Constants.CHROME:
                LogUtil.debug(TAG, "Chrome driver instantiated");
                System.setProperty("webdriver.chrome.driver", "C:\\Program Files (x86)\\Google\\Chrome\\Application\\chromedriver.exe");
                driver = new ChromeDriver();
                break;
            case Constants.FIREFOX:
                LogUtil.debug(TAG, "Firefox driver instantiated");
                driver = new FirefoxDriver();
                break;
            case Constants.IE:
                LogUtil.debug(TAG, "IE driver instantiated");
                System.setProperty("webdriver.ie.driver", "C:\\Windows\\System32\\IEDriverServer.exe");
                DesiredCapabilities desiredCapabilities = new DesiredCapabilities();
                desiredCapabilities.setCapability(InternetExplorerDriver.NATIVE_EVENTS, false);
                driver = new InternetExplorerDriver(desiredCapabilities);
                break;
            case Constants.OPERA:
                LogUtil.debug(TAG, "Opera driver instantiated");
                System.setProperty("webdriver.opera.driver", "C:\\Program Files (x86)\\Opera\\operadriver.exe");
                driver = new OperaDriver();
                break;
            case Constants.SAFARI:
                LogUtil.debug(TAG, "Safari driver instantiated");
                driver = new SafariDriver();
                break;
            default:

                break;
        }
        if(driver != null) {
            driver.manage().timeouts().implicitlyWait(1, TimeUnit.MINUTES);
            driver.manage().timeouts().setScriptTimeout(1, TimeUnit.MINUTES);
        }
        return driver;
    }

}
