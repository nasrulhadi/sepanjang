<?php

/**
 * This is the model class for table "background".
 *
 * The followings are the available columns in table 'background':
 * @property integer $bg_id
 * @property string $bg_author
 * @property string $bg_image
 * @property string $bg_title
 * @property string $bg_from
 * @property string $bg_date
 */
class Background extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'background';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('bg_author, bg_image, bg_title, bg_from, bg_date', 'required'),
			array('bg_author', 'length', 'max'=>20),
			array('bg_image', 'length', 'max'=>50),
			array('bg_title, bg_from', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('bg_id, bg_author, bg_image, bg_title, bg_from, bg_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'bg_id' => 'Bg',
			'bg_author' => 'Bg Author',
			'bg_image' => 'Bg Image',
			'bg_title' => 'Bg Title',
			'bg_from' => 'Bg From',
			'bg_date' => 'Bg Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('bg_id',$this->bg_id);
		$criteria->compare('bg_author',$this->bg_author,true);
		$criteria->compare('bg_image',$this->bg_image,true);
		$criteria->compare('bg_title',$this->bg_title,true);
		$criteria->compare('bg_from',$this->bg_from,true);
		$criteria->compare('bg_date',$this->bg_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Background the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
