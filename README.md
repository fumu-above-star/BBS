# BBS
週末プラン投稿用掲示板

![image](https://github.com/fumu-above-star/BBS/assets/129039778/2b73875f-7da2-41e9-a238-3b4cad40b236)

xamppを使用してローカル環境で構築を行う
xamppのmysqlでtest2というデータベースを作成しmembersとpostsというテーブルを作成する。
membersの設定を以下のようにする。
　　名前	       タイプ 	        照合順序	           Null	デフォルト値	  	           その他
	1	id 主キー	int(11)			                      いいえ	  なし		              AUTO_INCREMENT	
	2	name	    varchar(30)	  utf8mb4_general_ci	いいえ	  なし			
	3	email	    varchar(50)	  utf8mb4_general_ci	いいえ	  なし				
	4	password	varchar(255)	utf8mb4_general_ci	いいえ	  なし			
	5	created	  datetime			                    いいえ	  なし			
	6	modified	timestamp			                    いいえ	  current_timestamp()		ON UPDATE CURRENT_TIMESTAMP()
