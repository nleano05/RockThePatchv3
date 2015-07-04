package ui.annotations;


import ui.utils.Constants;
import java.lang.annotation.Documented;
import java.lang.annotation.Inherited;
import java.lang.annotation.Retention;
import java.lang.annotation.RetentionPolicy;


@SuppressWarnings("Annotation")
@Documented
@Inherited
@Retention(RetentionPolicy.RUNTIME)
public @interface Browser {
    String browser() default Constants.CHROME;
}