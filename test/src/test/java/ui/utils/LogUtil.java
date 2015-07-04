package ui.utils;


import com.sun.media.jfxmedia.logging.Logger;


public class LogUtil {

    private static final String TAG = LogUtil.class.getSimpleName();

    public static void info(String tag, String message) {
        Logger.logMsg(Logger.INFO, tag + ": " + message);
    }

    public static void debug(String tag, String message) {
        Logger.logMsg(Logger.DEBUG, tag + ": " + message);
    }

    public static void warning(String tag, String message) {
        Logger.logMsg(Logger.WARNING, tag + ": " + message);
    }

    public static void error(String tag, String message){
        Logger.logMsg(Logger.ERROR, tag + ": " + message);
    }
}
