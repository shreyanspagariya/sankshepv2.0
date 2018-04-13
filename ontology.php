<?php

$tree = array (
	"machine learning" =>
		array(
			"supervised",
			"unsupervised"
			),
		"supervised" =>
			array(
					"regression",
					"classification",
					"neural","deep",
					"knn","k-nn","nearest neighbour","nearest neighbor"
				),
				"regression" =>
					array(
							"linear regression",
							"logistic regression"
						),
					"linear regression" =>
						array(
								"gradient descent",
								"regularization"
							),
				"classification" =>
					array(
							"bayes",
							"decision tree",
							"svm","support vector machine"
						),
					"svm" =>
						array(
								"margin",
								"kernel",
								"dual"
							),
					"support vector machine" =>
						array(
								"margin",
								"kernel",
								"dual"
							),
				"neural" =>
					array(
							"backpropogation",
							"convolution","cnn"
						),
				"deep" =>
					array(
							"backpropogation",
							"convolution","cnn"
						),
		"unsupervised" =>
			array(
					"cluster",
					"dimensionality reduction",
					"collaborative filtering"
				),
			"cluster" =>
			array(
					"kmeans","k-means"
				),
			"dimensionality reduction" =>
				array(
						"feature selection",
						"feature extraction",
						"pca", "components analysis", "principal component", "component analysis"
					),

	);

$tree_nodes = array(
		"machine learning",
		"supervised",
		"unsupervised",
		"regression",
		"classification",
		"neural","deep",
		"knn","k-nn","nearest neighbour","nearest neighbor",
		"linear regression",
		"logistic regression",
		"gradient descent",
		"regularization",
		"bayes",
		"decision tree",
		"svm","support vector machine",
		"margin",
		"kernel",
		"dual",
		"backpropogation",
		"convolution","cnn",
		"cluster",
		"kmeans","k-means",
		"dimensionality reduction",
		"collaborative filtering",
		"feature selection",
		"feature extraction",
		"pca", "components analysis", "principal component", "component analysis"
	);

$parent = array(
		"supervised" => "machine learning",
		"unsupervised" => "machine learning",
		"regression" => "supervised",
		"classification" => "supervised",
		"neural" => "supervised",
		"deep" => "supervised",
		"knn" => "supervised",
		"k-nn" => "supervised",
		"nearest neighbour" => "supervised",
		"nearest neighbor" => "supervised",
		"linear regression" => "regression",
		"logistic regression" => "regression",
		"gradient descent" => "linear regression",
		"regularization" => "linear regression",
		"bayes" => "classification",
		"decision tree" => "classification",
		"svm" => "classification",
		"support vector machine" => "classification",
		"margin" => "svm",
		"kernel" => "svm",
		"dual" => "svm",
		"backpropogation" => "neural",
		"convolution" => "neural",
		"cnn" => "neural",
		"cluster" => "unsupervised",
		"kmeans" => "cluster",
		"k-means" => "cluster",
		"dimensionality reduction" => "unsupervised",
		"collaborative filtering" => "unsupervised",
		"feature selection" => "dimensionality reduction",
		"feature extraction" => "dimensionality reduction",
		"pca" => "dimensionality reduction", 
		"components analysis" => "dimensionality reduction", 
		"principal component" => "dimensionality reduction", 
		"component analysis" => "dimensionality reduction"
	);
?>
