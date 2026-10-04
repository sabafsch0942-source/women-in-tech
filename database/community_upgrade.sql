USE women_in_tech;

-- Allow community posts to be associated with a course.
ALTER TABLE community_posts ADD COLUMN course_id INT NULL AFTER user_id;
ALTER TABLE community_posts ADD INDEX idx_community_course (course_id);

-- Comments/replies for every community post.
CREATE TABLE community_comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    user_id INT NOT NULL,
    body TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_post_created (post_id, created_at),
    FOREIGN KEY (post_id) REFERENCES community_posts(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
