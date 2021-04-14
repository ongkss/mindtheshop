<?php
//상태 변경 로그 테이블 생성
$sql = "create table statuslog(
                                nb int(5) not null comment 'No.',
                                entCode char(15) not null comment '관리코드',
                                statusold char(2) default null comment '상품 이전상태',
                                statusnew char(2) default null comment '상품 현재상태',
                                optvalueold char(100) default null comment '옵션값 이전',
                                optvaluenew char(100) default null comment '옵션값 현재',
                                optvalue1old char(100) default null comment '옵션값1 이전',
                                optvalue1new char(100) default null comment '옵션값1 현재',
                                optvalue2old char(100) default null comment '옵션값2 이전',
                                optvalue2new char(100) default null comment '옵션값2 현재',
                                revdate datetime default null comment '수정일시',
                                primary key(nb))
                                charset=utf8 comment='상태 변경 로그';
        "



