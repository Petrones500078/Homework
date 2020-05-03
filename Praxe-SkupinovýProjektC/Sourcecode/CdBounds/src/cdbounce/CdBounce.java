/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package cdbounce;

import java.util.Random;
import javafx.animation.KeyFrame;
import javafx.animation.Timeline;
import javafx.application.Application;
import javafx.event.ActionEvent;
import javafx.event.EventHandler;
import javafx.geometry.Bounds;
import javafx.scene.Scene;
import javafx.scene.layout.Pane;
import javafx.scene.shape.Circle;
import javafx.stage.Stage;
import javafx.util.Duration;

/**
 *
 * @author Boubik
 */
public class CdBounce extends Application {

    public static Circle circle;
    public static Pane canvas;
    public double xm = 0;
    public double ym = 0;

    @Override
    public void start(final Stage primaryStage) {

        Random rand = new Random();
        canvas = new Pane();
        final Scene scene = new Scene(canvas, 800, 600);

        primaryStage.setTitle("CD Bounce");
        primaryStage.setScene(scene);
        primaryStage.show();

        // kolečko a vložení do prostřed
        circle = new Circle(20);
        circle.relocate(400, 300);

        canvas.getChildren().addAll(circle);

        // rnd směr pro x a rychlost
        xm = rand.nextInt(10);
        xm -= 5;
        if (xm >= 0) {
            xm++;
        }
        
        // rnd směr pro y a rychlost
        ym = rand.nextInt(10);
        ym -= 5;
        if (ym >= 0) {
            ym++;
        }

        final Timeline loop = new Timeline(new KeyFrame(Duration.millis(10), new EventHandler<ActionEvent>() {
            
            @Override
            public void handle(final ActionEvent t) {
                final Bounds bounds = canvas.getBoundsInLocal();
                
                circle.setLayoutX(circle.getLayoutX() + xm);
                circle.setLayoutY(circle.getLayoutY() + ym);

                if(circle.getLayoutX() >= (bounds.getMaxX() - circle.getRadius()) || circle.getLayoutX() <= (bounds.getMinX() + circle.getRadius())){
                    xm *= -1;
                }
                if (circle.getLayoutY() >= (bounds.getMaxY() - circle.getRadius()) || circle.getLayoutY() <= (bounds.getMinY() + circle.getRadius())) {
                    ym *= -1;
                }
                
            }
        }));

        loop.setCycleCount(Timeline.INDEFINITE);
        loop.play();
    }

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
        launch(args);
    }

}
