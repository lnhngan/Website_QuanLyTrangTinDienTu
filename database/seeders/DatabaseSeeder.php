<?php

namespace Database\Seeders;

// Thêm các Model cần dùng
use App\Models\User;
use App\Models\Category;
use App\Models\Team;
use App\Models\Game;
use App\Models\Tag;
use App\Models\Article;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1. Thêm người dùng
        $user1 = User::create([
            'name' => 'Admin Sport',
            'email' => 'admin@sportnews.com',
            'password' => Hash::make('password'), // <-- Mật khẩu mới là 'password'
            'role' => 'admin',
            'avatar' => 'avatars/admin.jpg',
        ]);
        $user2 = User::create([
            'name' => 'Biên tập viên Minh',
            'email' => 'editor@sportnews.com',
            'email_verified_at' => now(),
            'password' => '$2y$12$txPPX1Juc7PXAq0lAUi/AuPRLAGhvqez1PnoxFpf6jbU15E08z2Zm',
            'role' => 'editor',
            'avatar' => 'avatars/editor.jpg',
        ]);

        // 2. Thêm danh mục
        $cat1 = Category::create(['name' => 'Bóng đá', 'slug' => 'bong-da', 'description' => 'Tin tức bóng đá...']);
        $cat2 = Category::create(['name' => 'Bóng rổ', 'slug' => 'bong-ro', 'description' => 'NBA, VBA...']);
        $cat3 = Category::create(['name' => 'Tennis', 'slug' => 'tennis', 'description' => 'Grand Slam...']);
        $cat4 = Category::create(['name' => 'Cầu lông', 'slug' => 'cau-long', 'description' => 'BWF...']);
        $cat5 = Category::create(['name' => 'Bơi lội', 'slug' => 'boi-loi', 'description' => 'Olympic...']);

        // 3. Thêm đội bóng
        $team1 = Team::create(['name' => 'Việt Nam', 'logo' => 'teams/vietnam.png', 'sport_type' => 'football', 'country' => 'Việt Nam']);
        $team2 = Team::create(['name' => 'Thailand', 'logo' => 'teams/thailand.png', 'sport_type' => 'football', 'country' => 'Thái Lan']);
        $team3 = Team::create(['name' => 'Man Utd', 'logo' => 'teams/manutd.png', 'sport_type' => 'football', 'country' => 'Anh']);
        $team4 = Team::create(['name' => 'Lakers', 'logo' => 'teams/lakers.png', 'sport_type' => 'basketball', 'country' => 'Mỹ']);

       // 4. Thêm trận đấu (dùng Model mới 'Game')
        Game::create(['team_home' => $team1->id, 'team_away' => $team2->id, 'match_date' => '2025-11-10 19:00:00', 'venue' => 'Sân Mỹ Đình', 'status' => 'upcoming']);
        Game::create(['team_home' => $team3->id, 'team_away' => $team4->id, 'match_date' => '2025-11-05 03:30:00', 'venue' => 'Old Trafford', 'score_home' => 2, 'score_away' => 1, 'status' => 'finished']);
        Game::create(['team_home' => $team1->id, 'team_away' => $team3->id, 'match_date' => '2025-11-06 20:00:00', 'venue' => 'Sân Hàng Đẫy', 'score_home' => 1, 'score_away' => 1, 'status' => 'ongoing']);
                
        // 5. Thêm thẻ (tags)
        $tag1 = Tag::create(['name' => 'AFF Cup', 'slug' => 'aff-cup']);
        $tag2 = Tag::create(['name' => 'SEA Games', 'slug' => 'sea-games']);
        $tag3 = Tag::create(['name' => 'Premier League', 'slug' => 'premier-league']);
        $tag4 = Tag::create(['name' => 'HLV Park Hang-seo', 'slug' => 'park-hang-seo']);
        $tag5 = Tag::create(['name' => 'V-League', 'slug' => 'v-league']);
        $tag6 = Tag::create(['name' => 'Messi', 'slug' => 'messi']);
        $tag7 = Tag::create(['name' => 'Ronaldo', 'slug' => 'ronaldo']);
        $tag8 = Tag::create(['name' => 'NBA', 'slug' => 'nba']);

        // 6. Thêm bài viết
        $art1  = Article::create(['category_id' => $cat1->id, 'author_id' => $user1->id, 'title' => 'Việt Nam vs Thái Lan: Trận chung kết AFF Cup 2025', 'slug' => 'viet-nam-vs-thai-lan-chung-ket-aff-cup-2025', 'summary' => 'ĐT Việt Nam...sẽ đối đầu Thái Lan...', 'content' => '<p>Trận đấu được chờ đợi nhất...</p>', 'thumbnail' => 'thumbnails/vn-thai.jpg', 'status' => 'published', 'views' => 12500, 'published_at' => '2025-11-04 10:00:00']);
        $art2  = Article::create(['category_id' => $cat1->id, 'author_id' => $user2->id, 'title' => 'Man Utd thua sốc Lakers 1-2 trên sân nhà', 'slug' => 'man-utd-thua-soc-lakers', 'summary' => 'Trong trận giao hữu đặc biệt...', 'content' => '<p>Một trận đấu kỳ lạ...</p>', 'thumbnail' => 'thumbnails/mutd-lakers.jpg', 'status' => 'published', 'views' => 8900, 'published_at' => '2025-11-05 09:00:00']);
        $art3  = Article::create(['category_id' => $cat2->id, 'author_id' => $user1->id, 'title' => 'LeBron James lập triple-double, Lakers thắng đậm', 'slug' => 'lebron-triple-double-lakers', 'summary' => 'Ngôi sao 40 tuổi vẫn chứng minh...', 'content' => '<p>LeBron tiếp tục...</p>', 'thumbnail' => 'thumbnails/lebron.jpg', 'status' => 'published', 'views' => 6700, 'published_at' => '2025-11-03 08:00:00']);
        $art4  = Article::create(['category_id' => $cat3->id, 'author_id' => $user2->id, 'title' => 'Djokovic vô địch Paris Masters lần thứ 7', 'slug' => 'djokovic-vo-dich-paris-masters', 'summary' => 'Nole đánh bại Alcaraz...', 'content' => '<p>Ở tuổi 38, Djokovic...</p>', 'thumbnail' => 'thumbnails/djokovic.jpg', 'status' => 'published', 'views' => 4500, 'published_at' => '2025-11-02 07:00:00']);
        $art5  = Article::create(['category_id' => $cat1->id, 'author_id' => $user1->id, 'title' => 'V-League 2025/26: Hà Nội FC dẫn đầu sau 5 vòng', 'slug' => 'v-league-2025-ha-noi-dan-dau', 'summary' => 'Hà Nội FC bất bại...', 'content' => '<p>Thầy trò HLV Daiki Iwamasa...</p>', 'thumbnail' => 'thumbnails/hanoi-fc.jpg', 'status' => 'published', 'views' => 3200, 'published_at' => '2025-11-01 06:00:00']);
        $art6  = Article::create(['category_id' => $cat4->id, 'author_id' => $user2->id, 'title' => 'Lâm Quang Lê vô địch Việt Nam Open 2025', 'slug' => 'lam-quang-le-vo-dich', 'summary' => 'Tay vợt số 1 Việt Nam...', 'content' => '<p>Một chiến thắng...</p>', 'thumbnail' => 'thumbnails/lam-quang-le.jpg', 'status' => 'draft', 'views' => 0, 'published_at' => null]);
        $art7  = Article::create(['category_id' => $cat1->id, 'author_id' => $user1->id, 'title' => 'Ronaldo ghi hat-trick, Al Nassr vào chung kết', 'slug' => 'ronaldo-hat-trick', 'summary' => 'CR7 tiếp tục phong độ...', 'content' => '<p>3 bàn thắng đẹp mắt...</p>', 'thumbnail' => 'thumbnails/ronaldo.jpg', 'status' => 'published', 'views' => 15000, 'published_at' => '2025-10-30 05:00:00']);
        $art8  = Article::create(['category_id' => $cat2->id, 'author_id' => $user2->id, 'title' => 'VBA 2025: Saigon Heat bảo vệ ngôi vương', 'slug' => 'saigon-heat-vo-dich-vba', 'summary' => 'Heat đánh bại Hanoi Buffaloes...', 'content' => '<p>Chung kết kịch tính...</p>', 'thumbnail' => 'thumbnails/saigon-heat.jpg', 'status' => 'published', 'views' => 5100, 'published_at' => '2025-10-28 04:00:00']);
        $art9  = Article::create(['category_id' => $cat5->id, 'author_id' => $user1->id, 'title' => 'Ánh Viên trở lại thi đấu sau 2 năm nghỉ sinh', 'slug' => 'anh-vien-tro-lai', 'summary' => 'Kình ngư số 1 Việt Nam...', 'content' => '<p>Cảm xúc dâng trào...</p>', 'thumbnail' => 'thumbnails/anh-vien.jpg', 'status' => 'published', 'views' => 7800, 'published_at' => '2025-10-25 03:00:00']);
        $art10 = Article::create(['category_id' => $cat1->id, 'author_id' => $user2->id, 'title' => 'Park Hang-seo chính thức dẫn dắt ĐT Thái Lan', 'slug' => 'park-hang-seo-thai-lan', 'summary' => 'HLV Park trở lại Đông Nam Á...', 'content' => '<p>Một cú sốc lớn...</p>', 'thumbnail' => 'thumbnails/park-thai.jpg', 'status' => 'published', 'views' => 21000, 'published_at' => '2025-10-20 02:00:00']);

        // 7. Gán thẻ cho bài viết (Quan hệ Nhiều-Nhiều)
        $art1->tags()->attach([$tag1->id, $tag4->id, $tag5->id]);
        $art2->tags()->attach([$tag3->id, $tag7->id]);
        $art3->tags()->attach($tag8->id);
        $art4->tags()->attach($tag6->id);
        $art5->tags()->attach($tag5->id);
        $art7->tags()->attach($tag7->id);
        $art8->tags()->attach($tag8->id);
        $art9->tags()->attach($tag2->id);
        $art10->tags()->attach([$tag1->id, $tag4->id]);
        
        // 8. Thêm bình luận
        Comment::create(['article_id' => $art1->id, 'user_id' => $user1->id, 'content' => 'Hy vọng Việt Nam vô địch lần này!', 'status' => 'approved']);
        Comment::create(['article_id' => $art1->id, 'name' => 'Nguyễn Văn A', 'email' => 'a@gmail.com', 'content' => 'Thái Lan mạnh lắm, khó đấy!', 'status' => 'approved']);
        Comment::create(['article_id' => $art2->id, 'user_id' => $user2->id, 'content' => 'Trận này vui thật!', 'status' => 'approved']);
        Comment::create(['article_id' => $art10->id, 'name' => 'Hoàng E', 'email' => 'e@gmail.com', 'content' => 'Không ngờ thầy Park lại sang Thái Lan...', 'status' => 'pending']);
        
        // 9. Thêm ảnh (bỏ qua nếu không cần thiết cho seeder)
        // 10. Thêm video (bỏ qua nếu không cần thiết cho seeder)

        // 11. Cài đặt hệ thống
        Setting::create(['name' => 'site_name', 'value' => 'Sport News VN']);
        Setting::create(['name' => 'site_description', 'value' => 'Tin tức thể thao nhanh, chính xác...']);
        Setting::create(['name' => 'contact_email', 'value' => 'contact@sportnews.com']);
    }
}