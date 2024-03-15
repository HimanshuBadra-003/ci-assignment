pipeline {
    agent any
    
    stages {
        stage('Verify Version') {
            steps {
                // Run PHP file
                sh 'php --version'
            }
        }
        stage('Run File') {
            steps {
                // Run PHP file
                sh 'php index.php'
            }
        }
    }
}